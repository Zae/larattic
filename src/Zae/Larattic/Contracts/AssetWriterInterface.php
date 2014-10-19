<?php namespace Zae\Larattic\Contracts;

use Assetic\Asset\AssetInterface as AsseticAssetInterface;

/**
 * Interface AssetWriterInterface
 *
 * @package Zae\Larattic\Contracts
 */
interface AssetWriterInterface
{
	/**
	 * Constructor.
	 *
	 * @param string $dir    The base directory
	 * @param array  $values Variable values
	 *
	 * @throws \InvalidArgumentException if a variable value is not a string
	 */
	public function __construct($dir, array $values = []);

	/**
	 * @param AsseticAssetInterface $asset
	 *
	 * @return mixed
	 */
	public function writeAsset(AsseticAssetInterface $asset);
}