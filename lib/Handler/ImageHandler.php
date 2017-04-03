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
        $handlers = [];
        foreach ($this->validExt as $ext) {
            $handlers[$ext] = HandlerTools::getBinaryHandler($ext);
        }

        foreach ($this->files as $file) {

            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

            if($handlers[$ext]) {
                echo get_class()." обрабатывает файл: $file\n";
                exec($handlers[$ext] . ' - o2 ' . escapeshellarg($file));
            } else {
                echo "Не найден бинарный обработчик для файла: $file\n";
            }
        }
    }
}
