<?php

namespace Dumkaaa\BxOptimize\Finder;

use Exception;

class FilesFinder implements FinderInterface
{
    /** @var string Путь к папке, в которой будем искать файлы */
    protected $path;

    /**
     * {@inheritdoc}
     */
    public function __construct($path)
    {
        $path = trim($path, '\/');
        if (empty($path) || !(is_dir($path) || is_file($path)) || !is_writable($path)) {
            throw new Exception('Путь не может быть пустым или нет доступа');
        }
        $this->path = $path;
    }

    /**
     * {@inheritdoc}
     */
    public function findFiles($path = null)
    {
        $path = $path ?: $this->path;
        $basePath = $_SERVER['DOCUMENT_ROOT'];

        return new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($basePath.'/'.$path)
        );
    }
}
