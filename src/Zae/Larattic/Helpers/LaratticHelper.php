<?php namespace Zae\Larattic\Helpers;

/**
 * Class LaratticHelper
 *
 * @package Zae\Larattic\Helpers
 */
trait LaratticHelper
{
	/**
	 * @param $haystack
	 * @param $needles
	 *
	 * @return bool
	 */
	protected function str_endswith($haystack, $needles)
	{
		foreach ((array) $needles as $needle)
		{
			if ((string) $needle === substr($haystack, -strlen($needle))) return true;
		}

		return false;
	}
}