<?php


namespace Dumkaaa\BxOptimize;



interface OptimizerInterface
{
    /**
     * OptimizerInterface constructor.
     * @param Finder\FinderInterface $finder
     * @param Handler\HandlerProcessor $handler
     */
    public function __construct(Finder\FinderInterface $finder, Handler\HandlerProcessor $handler);

    /**
     * Применяет требуемые оптимизации
     * @return mixed
     */
    public function optimize();

}