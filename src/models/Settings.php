<?php
/**
 * Nanoslugs plugin for Craft CMS 3.x
 *
 * Hashes the Id of an entry when it is saved and replaces the slug.
 *
 * @link      https://coryzibell.com
 * @copyright Copyright (c) 2018 Cory Zibell
 */

namespace coryzibell\nanoslugs\models;

use coryzibell\nanoslugs\Nanoslugs;

use Craft;
use craft\base\Model;

/**
 * @author    Cory Zibell
 * @package   Nanoslugs
 * @since     1.0.0
 */
class Settings extends Model
{
    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $length = 8;
    public $alphabet = '0123456789abcdefghijklmnopqrstuvwxyz-';
    public $sections = array();

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['length', 'number'],
            ['length', 'default', 'value' => 8],
            ['alphabet', 'string'],
            ['alphabet', 'default', 'value' => 'abcdefghijklmnopqrstuvwxyz123456789'],
        ];
    }
}
