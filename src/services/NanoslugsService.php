<?php
/**
 * Nanoslugs plugin for Craft CMS 3.x
 *
 * Hashes the Id of an entry when it is saved and replaces the slug.
 *
 * @link      coryzibell.com
 * @copyright Copyright (c) 2018 Cory Zibell
 */

namespace coryzibell\nanoslugs\services;

use coryzibell\nanoslugs\Nanoslugs;

use Craft;
use craft\base\Component;

/**
 * @author    Cory Zibell
 * @package   Nanoslugs
 * @since     1.0.0
 */
class NanoslugsService extends Component
{

	protected $length;
	protected $alphabet;
	protected $encoder;

	public function __construct()
	{
		$settings = Craft::$app->plugins->getPlugin('nanoslugs')->getSettings();
		$this->length = $settings['length'];
		$this->alphabet = $settings['alphabet'];
		$this->encoder = new \Hidehalo\Nanoid\Client();
	}


    /**
	 * Encode the id and return it
	 *
	 * This method will take EntryModel that's passed and encode it's ID, the entries slug attribute will then be replaced
	 * with the encoded ID and saved.
	 *
	 * @param $id  A number to hash.
	 *
	 *
	 * @return string|$encodedId the encoded ID
	 */
	public function encodeFromSettings($settings)
	{
		if ( $settings['length'] ){
			$length = $settings['length'];
		} else {
			$length = $this->length;
		}

		if ( $settings['alphabet'] ) {
			$alphabet = $settings['alphabet'];
		} else {
			$alphabet = $this->alphabet;
		}

		return $this->encoder->formatedId($alphabet, (int)$length);
	}

	public function generate($length, $alphabet)
	{
		return $this->encoder->formatedId($alphabet, (int)$length);
	}
}
