<?php


namespace Dumkaaa\BxOptimize\Handler;


class CssHandler extends Handler
{
    /** {@inheritdoc} */
    protected $validExt = [
        'css',
    ];

    /**
     * {@inheritdoc}
     */
    public function handleQueue()
    {
        foreach ($this->files as $file) {
            print(get_class() . " обрабатывает файл: $file\n");
        }
        // TODO: Implement handleQueue() method.
    }
}