<?php namespace Zae\Larattic\Contracts;

/**
 * Interface ContainerInterface
 *
 * @package Zae\Larattic\Contracts
 */
interface ContainerInterface
{
	/**
	 * @param       $abstract
	 * @param array $parameters
	 *
	 * @return mixed
	 */
	public function make($abstract, $parameters = array());
}