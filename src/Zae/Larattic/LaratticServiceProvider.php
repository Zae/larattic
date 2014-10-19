<?php namespace Zae\Larattic;

use Illuminate\Support\ServiceProvider;
use Zae\Larattic\Command\AssetCompilationCommand;

/**
 * Class LaratticServiceProvider
 *
 * @package Zae\Larattic
 */
class LaratticServiceProvider extends ServiceProvider
{

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
	}

	/**
	 *
	 */
	public function boot()
	{
		/*
		 * Define the package name for laravel.
		 */
		$this->package('zae/larattic');

		$this->app->bind('Zae\Larattic\Contracts\ContainerInterface', 'Zae\Larattic\Adapters\LaravelContainerAdapter');
		$this->app->bind('Zae\Larattic\Contracts\ConfigInterface', 'Zae\Larattic\Adapters\LaravelConfigRepositoryAdapter');
		$this->app->bind('Zae\Larattic\Contracts\AssetManagerInterface', 'Zae\Larattic\Adapters\AsseticAssetManagerAdapter');
		$this->app->bind('Zae\Larattic\Contracts\FilterManagerInterface', 'Zae\Larattic\Adapters\AsseticFilterManagerAdapter');
		$this->app->bind('Zae\Larattic\Contracts\FilesystemInterface', 'Zae\Larattic\Adapters\LaravelFilesystemAdapter');
		$this->app->bind('Zae\Larattic\Contracts\AssetWriterInterface', 'Zae\Larattic\Adapters\AsseticAssetWriterAdapter');

		/*
		 * Bind Asset as larattic in the IoC.
		 */
		$this->app->bind('larattic', 'Zae\Larattic\Asset\Asset');

		/*
		 * Bind the AssetCompilationCommand in the IoC as command.larattic.compile
		 */
		$this->app['command.larattic.compile'] = $this->app->share(
			function ($app) {
				return new AssetCompilationCommand($this->app->make('Zae\Larattic\Asset\Asset'), $this->app->make('Zae\Larattic\Contracts\FilesystemInterface'));
			}
		);
		/*
		 * Define the commands provided by this ServiceProvider.
		 */
		$this->commands('command.larattic.compile');
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return ['larattic', 'command.larattic.compile'];
	}

}
