<?php namespace Zae\Larattic\Filters;

use Assetic\Asset\AssetInterface;
use Assetic\Filter\FilterInterface;
use Less_Cache;
use Zae\Larattic\Helpers\LaratticHelper;

/**
 * Class LessFilter
 *
 * @package EzAssetic\Filters
 */
class LessCacheFilter implements FilterInterface
{
	use LaratticHelper;

	/**
	 * @var array
	 */
	protected $options = [];

	/**
	 * @param $cache_dir
	 */
	public function setCacheDir($cache_dir)
	{
		$this->options['cache_dir'] = $cache_dir;
	}

	/**
	 * @param $compress
	 */
	public function setCompress($compress)
	{
		$this->options['compress'] = $compress;
	}

	/**
	 * Filters an asset after it has been loaded.
	 *
	 * @param AssetInterface $asset An asset
	 */
	public function filterLoad(AssetInterface $asset)
	{
		if ( $this->str_endswith($asset->getSourcePath(), ['.less']) ) {

			$file = Less_Cache::Get([
				$asset->getSourceRoot().DIRECTORY_SEPARATOR.$asset->getSourcePath() => '/'
			], $this->options);

			if (is_readable($this->options['cache_dir'].DIRECTORY_SEPARATOR.$file)) {
				$asset->setContent(file_get_contents($this->options['cache_dir'].DIRECTORY_SEPARATOR.$file));
			}
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