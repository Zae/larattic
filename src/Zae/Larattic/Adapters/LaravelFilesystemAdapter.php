<?php namespace Zae\Larattic\Adapters;

use Illuminate\Filesystem\Filesystem;
use Zae\Larattic\Contracts\FilesystemInterface;

/**
 * Class LaravelFilesystemAdapter
 *
 * @package Zae\Larattic\Adapters
 */
class LaravelFilesystemAdapter extends Filesystem implements FilesystemInterface
{

}