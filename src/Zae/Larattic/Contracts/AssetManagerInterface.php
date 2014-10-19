<?php namespace Zae\Larattic\Contracts;

use Assetic\Asset\AssetInterface as AsseticAssetInterface;

/**
 * Manages assets.
 *
 * @author Kris Wallsmith <kris.wallsmith@gmail.com>
 */
interface AssetManagerInterface
{

	/**
	 * Registers an asset to the current asset manager.
	 *
	 * @param string         $name  The asset name
	 * @param AssetInterface $asset The asset
	 *
	 * @throws \InvalidArgumentException If the asset name is invalid
	 */
	public function set($name, AsseticAssetInterface $asset);
}