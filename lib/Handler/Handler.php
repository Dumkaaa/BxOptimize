<?php

namespace Dumkaaa\BxOptimize\Handler;

abstract class Handler implements HandlerInterface
{
    /** @var array Допустимые этим обработчиком разрешения файлов */
    protected $validExt = [];

    /** @var array Очередь файлов на обработку */
    protected $files = [];

    /**
     * {@inheritdoc}
     */
    public function canHandleFile($file = null)
    {
        if (is_null($file)) {
            throw new \Exception('В обработчик '.get_class()." передано неверное имя файла: $file");
        }

        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

        return in_array($ext, $this->validExt);
    }

    /**
     * {@inheritdoc}
     */
    public function queueFile($file)
    {
        $this->files[] = $file;
    }

    /**
     * {@inheritdoc}
     */
    public function handleQueue()
    {
        foreach ($this->files as $file) {
            echo get_class()." обрабатывает файл: $file\n";
        }
        // TODO: Implement handleQueue() method.
    }
}
