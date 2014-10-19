<?php namespace Zae\Larattic\Contracts;

use Assetic\Asset\AssetCollection;
use Assetic\Factory\Worker\WorkerInterface;

/**
 * Interface AssetFactoryInterface
 *
 * @package Zae\Larattic\Contracts
 */
interface AssetFactoryInterface
{
	/**
	 * Adds a factory worker.
	 *
	 * @param WorkerInterface $worker A worker
	 */
	public function addWorker(WorkerInterface $worker);

	/**
	 * Sets the asset manager to use when creating asset references.
	 *
	 * @param AssetManagerInterface $am The asset manager
	 */
	public function setAssetManager(AssetManagerInterface $am);

	/**
	 * Sets the filter manager to use when adding filters.
	 *
	 * @param FilterManagerInterface $fm The filter manager
	 */
	public function setFilterManager(FilterManagerInterface $fm);

	/**
	 * Creates a new asset.
	 *
	 * Prefixing a filter name with a question mark will cause it to be
	 * omitted when the factory is in debug mode.
	 *
	 * Available options:
	 *
	 *  * output: An output string
	 *  * name:   An asset name for interpolation in output patterns
	 *  * debug:  Forces debug mode on or off for this asset
	 *  * root:   An array or string of more root directories
	 *
	 * @param array|string $inputs  An array of input strings
	 * @param array|string $filters An array of filter names
	 * @param array        $options An array of options
	 *
	 * @return AssetCollection An asset collection
	 */
	public function createAsset($inputs = array(), $filters = array(), array $options = array());
}