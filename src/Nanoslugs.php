<?php
/**
 * Nanoslugs plugin for Craft CMS 3.x
 *
 * Uses nanoid to generate a slug for new entries
 *
 * @link      https://madmadmad.com
 * @copyright Copyright (c) 2018 Cory Zibell
 */

namespace coryzibell\nanoslugs;

use coryzibell\nanoslugs\services\NanoslugsService as NanoslugsServiceService;
use coryzibell\nanoslugs\variables\NanoslugsVariable;
use coryzibell\nanoslugs\models\Settings;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;
use craft\services\Elements;
use craft\web\twig\variables\CraftVariable;

use yii\base\Event;

/**
 * Class Nanoslugs
 *
 * @author    Cory Zibell
 * @package   Nanoslugs
 * @since     1.0.0
 *
 * @property  NanoslugsServiceService $nanoslugsService
 */
class Nanoslugs extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var Nanoslugs
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $schemaVersion = '1.0.0';

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        $this->setComponents([
			'NanoslugsService' => services\NanoslugsService::class,
		]);

        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function (Event $event) {
                /** @var CraftVariable $variable */
                $variable = $event->sender;
                $variable->set('nanoslugs', NanoslugsVariable::class);
            }
        );

        Event::on(
            Plugins::class,
            Plugins::EVENT_AFTER_INSTALL_PLUGIN,
            function (PluginEvent $event) {
                if ($event->plugin === $this) {
                }
            }
        );

       Event::on(Elements::class, Elements::EVENT_AFTER_SAVE_ELEMENT, function(Event $event){

            // Only create new slug if element is entry and new entry
            if ( ($event->element instanceof \craft\elements\Entry) && $event->isNew )
            {

                // Get the settings
                $pluginSettings = $this->getSettings();
                // Get the section
                $sectionId = $event->element->sectionId;

                // Get the nanoslugs settings
                if (isset($pluginSettings['sections'][$sectionId]))
                {
                    $settings = $pluginSettings['sections'][$sectionId];
                } else {
                    $settings['enabled'] = false;
                }

                // We only want to generate the slug if its enabled in the nanoslugs settings
                if($settings['enabled'])
                {
                    $slug = $this->NanoslugsService->encodeById($event->element->id, $settings);
                    $event->element->slug = $slug;
                    Craft::$app->elements->saveElement($event->element);

                }
            }
        });

        Craft::info(
            Craft::t(
                'nanoslugs',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

    // Protected Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    protected function createSettingsModel()
    {
        return new Settings();
    }

    /**
     * @inheritdoc
     */
    protected function settingsHtml(): string
    {
        return Craft::$app->view->renderTemplate(
            'nanoslugs/settings',
            [
                'settings' => $this->getSettings()
            ]
        );
    }
}
