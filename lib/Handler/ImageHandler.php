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
    protected $args = [
        'png' => ' -o2 ',
        'jpg' => '  -progressive -copy none -optimize -outfile %s %s', // dest, src
        'jpeg' => '  -progressive -copy none -optimize -outfile %s %s', // dest, src
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
                switch ($ext) {
                    case 'png':
                        exec($handlers[$ext] . ' ' . $this->args[$ext]  . ' ' . escapeshellarg($file));
                        break;
                    case 'jpg':
                    case 'jpeg':
                        exec($handlers[$ext]  . ' ' . $this->args[$ext]  . ' ' . escapeshellarg($file) . ' ' . escapeshellarg($file));
                        break;
                }
            } else {
                echo "Не найден бинарный обработчик для файла: $file\n";
            }
        }
    }
}
