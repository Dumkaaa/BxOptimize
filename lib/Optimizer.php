<?php

namespace Dumkaaa\BxOptimize;

use Dumkaaa\BxOptimize\Handler\HandlerInterface;

class Optimizer implements OptimizerInterface
{
    /** @var Finder\FinderInterface null */
    protected $finder = null;

    /** @var Handler\HandlerInterface */
    protected $handlers;

    /** @var array Массив найденных файлов для обработки */
    private $files = [];

    /**
     * {@inheritdoc}
     */
    public function __construct(Finder\FinderInterface $finder = null, Handler\HandlerProcessor $handler = null)
    {
        $this->finder = $finder;
        $this->handlers = $handler->getHandlers();
    }

    /**
     * {@inheritdoc}
     */
    public function optimize()
    {
        $this->findFiles();
        $this->setQueue();
        $this->handleQueue();
    }

    private function setQueue()
    {
        /** @var HandlerInterface $handler */
        foreach ($this->handlers as $handler) {
            foreach ($this->files as $file) {
                if (!$handler->canHandleFile($file)) {
                    continue;
                } else {
                    $handler->queueFile($file);
                }
            }
        }
    }

    private function handleQueue()
    {
        /** @var HandlerInterface $handler */
        foreach ($this->handlers as $handler) {
            $handler->handleQueue();
        }
    }

    private function findFiles()
    {
        $this->files = $this->finder->findFiles();
    }
}
