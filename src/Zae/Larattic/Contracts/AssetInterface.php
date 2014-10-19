<?php namespace Zae\Larattic\Contracts;

/**
 * Interface AssetInterface
 *
 * @package Zae\Larattic\Contracts
 */
interface AssetInterface
{
	/**
	 * @param string                $name
	 * @param AssetFactoryInterface $factory
	 * @param null                  $details
	 *
	 * @return string
	 */
	public function asset($name = null, AssetFactoryInterface $factory = null, &$details = null);
}