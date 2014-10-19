<?php namespace Zae\Larattic\Filters;

use Assetic\Asset\AssetInterface;
use Assetic\Filter\FilterInterface;
use Zae\Larattic\Helpers\LaratticHelper;

/**
 * Class LessFilter
 *
 * @package EzAssetic\Filters
 */
class LessFilter implements FilterInterface
{
	use LaratticHelper;

	/**
	 * @var array
	 */
	protected $options = [];

	/**
	 * @var \Less_Parser
	 */
	private $parser;

	/**
	 * @param \Less_Parser $parser
	 */
	function __construct(\Less_Parser $parser)
	{
		$this->parser = $parser;

		if (extension_loaded('xdebug')) {
			ini_set('xdebug.max_nesting_level', 1000);
		}
	}

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
		$parser = clone $this->parser;

		$parser->SetOptions($this->options);

		if ( $this->str_endswith($asset->getSourcePath(), ['.less']) ) {
			$parser->parseFile($asset->getSourceRoot().DIRECTORY_SEPARATOR.$asset->getSourcePath());
			$asset->setContent($parser->getCss());
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