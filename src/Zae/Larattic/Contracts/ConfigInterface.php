<?php namespace Zae\Larattic\Contracts;

/**
 * Interface ConfigInterface
 *
 * @package Zae\Larattic\Contracts
 */
interface ConfigInterface
{

	/**
	 * Get the specified configuration value.
	 *
	 * @param  string $key
	 * @param  mixed  $default
	 * @return mixed
	 */
	public function get($key, $default = null);
}