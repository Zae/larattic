<?php namespace Zae\Larattic\Command;

use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Symfony\Component\Console\Input\InputArgument;
use Zae\Larattic\Asset\Asset;
use Zae\Larattic\Contracts\FilesystemInterface;

/**
 * Class AssetCompilationCommand
 *
 * @package Zae\Larattic\Command
 */
class AssetCompilationCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'assets:compile';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Compile the named asset.';

	/**
	 * @var Asset
	 */
	private $asset;

	/**
	 * @var FilesystemInterface
	 */
	private $filesystem;

	/**
	 * Create a new command instance.
	 *
	 * @param Asset               $asset
	 * @param FilesystemInterface $filesystem
	 */
	public function __construct(Asset $asset, FilesystemInterface $filesystem)
	{
		parent::__construct();

		$this->asset = $asset;
		$this->filesystem = $filesystem;
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$name = $this->argument('name');
		$this->asset->asset($name, null, $details);

		if (Arr::get($details, 'lock', false)) {
			$this->filesystem->delete($details['lock']);
			$this->asset->asset($name, null, $details);
		}

		symlink($details['root'].DIRECTORY_SEPARATOR.$details['filepath'], $details['root'].DIRECTORY_SEPARATOR."{$name}.lock");
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('name', InputArgument::REQUIRED, 'The name of the asset to compile.'),
		);
	}

}
