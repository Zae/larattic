<?php namespace Zae\Larattic\Adapters;

use Illuminate\Config\Repository;
use Zae\Larattic\Contracts\ConfigInterface;

/**
 * Class LaravelConfigRepositoryAdapter
 *
 * @package Zae\Larattic\Adapters
 */
class LaravelConfigRepositoryAdapter implements ConfigInterface
{
	/**
	 * @var Repository
	 */
	private $repository;

	/**
	 * @param Repository $repository
	 */
	function __construct(Repository $repository)
	{
		$this->repository = $repository;
	}

	/**
	 * Determine if the given configuration value exists.
	 *
	 * @param  string $key
	 *
	 * @return bool
	 */
	public function has($key)
	{
		return $this->repository->has($key);
	}

	/**
	 * Get the specified configuration value.
	 *
	 * @param  string $key
	 * @param  mixed  $default
	 *
	 * @return mixed
	 */
	public function get($key, $default = null)
	{
		return $this->repository->get($key, $default);
	}

	/**
	 * Set a given configuration value.
	 *
	 * @param  string $key
	 * @param  mixed  $value
	 *
	 * @return void
	 */
	public function set($key, $value)
	{
		$this->repository->set($key, $value);
	}
}