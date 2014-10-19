<?php namespace Zae\Larattic\Filters;

use Assetic\Asset\AssetInterface;
use Assetic\Filter\FilterInterface;
use MattCG\cjsDelivery\Delivery;
use Zae\Larattic\Helpers\LaratticHelper;

/**
 * Class CommonJSFilter
 *
 * @package Zae\Larattic\Filters
 */
class CommonJSFilter implements FilterInterface
{
	use LaratticHelper;

	/**
	 * @var Delivery
	 */
	private $delivery;

	/**
	 * @param Delivery $delivery
	 */
	function __construct(Delivery $delivery)
	{
		$this->delivery = $delivery;
	}

	/**
	 * Filters an asset after it has been loaded.
	 *
	 * @param AssetInterface $asset An asset
	 */
	public function filterLoad(AssetInterface $asset)
	{
		if ($this->str_endswith($asset->getSourcePath(), ['.js'])) {
			$moduleName = basename($asset->getSourcePath(), '.js');

			$delivery = $this->delivery->create(['includes' => [$asset->getSourceRoot()]]);
			$delivery->addModule($moduleName);
			$delivery->setMainModule($moduleName);

			$asset->setContent($delivery->getOutput());
		}
	}

	/**
	 * Filters an asset just before it's dumped.
	 *
	 * @param AssetInterface $asset An asset
	 */
	public function filterDump(AssetInterface $asset)
	{
	}
}