<?php namespace Zae\Larattic\Contracts;

use Illuminate\Filesystem\FileNotFoundException;

/**
 * Interface FilesystemInterface
 *
 * @package Zae\Larattic\Contracts
 */
interface FilesystemInterface
{
	/**
	 * Get the contents of a file.
	 *
	 * @param  string $path
	 * @return string
	 * @throws FileNotFoundException
	 */
	public function get($path);

	/**
	 * Determine if a file exists.
	 *
	 * @param  string  $path
	 * @return bool
	 */
	public function exists($path);

	/**
	* Delete the file at a given path.
	*
	* @param  string|array  $paths
	* @return bool
	*/
	public function delete($paths);

	/**
	 * Write the contents of a file.
	 *
	 * @param  string  $path
	 * @param  string  $contents
	 * @return int
	 */
	public function put($path, $contents);
}