<?php namespace Zae\Larattic\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * Class Larattic
 *
 * @package Zae\Larattic\Facade
 */
class Larattic extends Facade
{
	/**
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		return 'larattic';
	}

}