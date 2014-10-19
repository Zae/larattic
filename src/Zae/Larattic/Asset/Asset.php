<?php namespace Zae\Larattic\Asset;

use Assetic\AssetManager;
use Assetic\Factory\AssetFactory;
use Assetic\FilterManager;
use Illuminate\Config\Repository as Config;
use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Zae\Larattic\Contracts\AssetFactoryInterface;
use Zae\Larattic\Contracts\AssetInterface;
use Zae\Larattic\Contracts\AssetManagerInterface;
use Zae\Larattic\Contracts\ConfigInterface;
use Zae\Larattic\Contracts\ContainerInterface;
use Zae\Larattic\Contracts\FilesystemInterface;
use Zae\Larattic\Contracts\FilterManagerInterface;

/**
 * Class Asset
 *
 * @package Zae\Larattic\Asset
 */
class Asset implements AssetInterface
{

	/**
	 * @var Config
	 */
	private $config;

	/**
	 * @var AssetManager
	 */
	private $assetManager;

	/**
	 * @var FilterManager
	 */
	private $filterManager;

	/**
	 * @var Filesystem
	 */
	private $filesystem;

	/**
	 * @var Container
	 */
	private $container;

	/**
	 * @param ContainerInterface         $container
	 * @param ConfigInterface               $config
	 * @param AssetManagerInterface   $assetManager
	 * @param FilterManagerInterface $filterManager
	 * @param FilesystemInterface       $filesystem
	 */
	function __construct(ContainerInterface $container, ConfigInterface $config, AssetManagerInterface $assetManager, FilterManagerInterface $filterManager, FilesystemInterface $filesystem)
	{
		$this->config = $config;
		$this->assetManager = $assetManager;
		$this->filterManager = $filterManager;
		$this->filesystem = $filesystem;
		$this->container = $container;
	}

	/**
	 * @param string         $name
	 * @param AssetFactory $factory
	 * @param null         $details
	 *
	 * @return string
	 */
	public function asset($name = null, AssetFactoryInterface $factory = null, &$details = null)
	{
		/*
		 * Get the necessary configuration from the config file.
		 */
//		if (is_null($name)) {
//			$root = $this->config->get("larattic::root");
//			$assets = Collection::make($this->config->get("larattic::assets"));
//			$assetCache = Collection::make($this->config->get("larattic::assetCache"));
//			$filters = Collection::make($this->config->get("larattic::filters"));
//			$workers = Collection::make($this->config->get("larattic::workers"));
//			$options = Collection::make($this->config->get("larattic::options"));
//			$public_uri = $this->config->get("larattic::public_uri");
//		} else {
		$root = $this->config->get("larattic::{$name}.root");
		$assets = Collection::make($this->config->get("larattic::{$name}.assets"));
		$assetCache = Collection::make($this->config->get("larattic::{$name}.assetCache"));
		$filters = Collection::make($this->config->get("larattic::{$name}.filters"));
		$workers = Collection::make($this->config->get("larattic::{$name}.workers"));
		$options = Collection::make($this->config->get("larattic::{$name}.options"));
		$public_uri = $this->config->get("larattic::{$name}.public_uri");
//		}

		$details['root'] = $root;
		$details['public_uri'] = $public_uri;

		/*
		 * Check if a named lock file exists, if it does, skip the creation and return directly.
		 */
		if ($this->filesystem->exists($root.DIRECTORY_SEPARATOR."{$name}.lock")) {
			$filepath = readlink($root.DIRECTORY_SEPARATOR."{$name}.lock");

			if ($this->filesystem->exists($filepath)) {
				$details['lock'] = $root.DIRECTORY_SEPARATOR."{$name}.lock";
				return asset($public_uri.basename($filepath));
			}
		} //elseif (($filepath = \Cache::get("{$name}.manifest"))) {
//			if (file_exists($filepath)) {
//				return asset($public_uri.basename($filepath));
//			}
//		}

		/*
		 * If an AssetFactory was not injected, instantiate one.
		 */
		if (is_null($factory) ) {
			$factory = $this->container->make('Assetic\Factory\AssetFactory', [$root]);
		}

		/*
		 * If we want to use the assetCache, instantiate all caches and return the assetReferences.
		 */
		if ($assetCache) {
			$assets = $assets->map(function($asset, $name) use(&$factory, &$assetCache) {
				$this->assetManager->set($name, $this->container->make($assetCache->get('assetcache'), [$factory->createAsset($asset), $this->container->make($assetCache->get('cache'), [$assetCache->get('storage_path')])]));
				return "@{$name}";
			});
		}

		/*
		 * Instantiate all the filters.
		 */
		$filters->map(function($filter, $name) use(&$factory) {
			$this->filterManager->set($name, $this->container->make($filter));
		});

		/*
		 * Set the assetManager and filterManager on the factory.
		 */
		$factory->setAssetManager($this->assetManager);
		$factory->setFilterManager($this->filterManager);

		/*
		 * Add workers if needed.
		 */
		$workers->each(function($worker) use (&$factory) {
			$factory->addWorker($this->container->make($worker));
		});

		/*
		 * Add the default CacheBustingWorker
		 */
		$factory->addWorker($this->container->make('Assetic\Factory\Worker\CacheBustingWorker'));

		/*
		 * Create all the assets with the createAsset method of the factory.
		 */
		$css = $factory->createAsset($assets->toArray(), $filters->keys(), $options->toArray());

		$filepath = $css->getTargetPath();

		$details['filepath'] = $filepath;

		/*
		 * If the file that was returned by the factory already exists, we don't need to write it again.
		 * CacheBustingWorker makes sure the filename is regenerated when the file changes.
		 */
		if (!file_exists($root.DIRECTORY_SEPARATOR.$filepath)) {
			$cssWriter = $this->container->make('Zae\Larattic\Adapters\AsseticAssetWriterAdapter', [$root]);
			$cssWriter->writeAsset($css);

//			\Cache::put("{$name}.manifest", $root.DIRECTORY_SEPARATOR.$filepath, 60);
		}

		return asset($public_uri.basename($filepath));
	}
}