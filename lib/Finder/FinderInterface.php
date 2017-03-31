<?php

namespace Dumkaaa\BxOptimize\Finder;

interface FinderInterface
{
    /**
     * FilesFinder constructor.
     *
     * @param string $path Путь к папке, в которой будем искать файлы
     *
     * @throws \Exception
     */
    public function __construct($path);

    /**
     * Ищет файлы в указанной папке, включая вложенные.
     *
     * @param string $path
     *
     * @return \RecursiveIteratorIterator
     */
    public function findFiles($path = null);
}
