<?php

namespace Dumkaaa\BxOptimize\Handler;

class ImageHandler extends Handler
{
    /** {@inheritdoc} */
    protected $validExt = [
        'png',
        'jpeg',
        'jpg',
    ];

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
