<?php namespace Zae\Larattic\Contracts;

/**
 * Interface FilterManagerInterface
 *
 * @package Zae\Larattic\Contracts
 */
interface FilterManagerInterface
{

	/**
	 * @param $alias
	 * @return mixed
	 */
	public function get($alias);
}