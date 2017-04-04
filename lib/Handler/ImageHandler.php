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
        'png' => ' -o7 %s',
        'jpg' => ' -progressive -copy none -optimize -outfile %s %s', // dest, src
        'jpeg' => ' -progressive -copy none -optimize -outfile %s %s', // dest, src
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

            $command = false;

            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

            if ($handlers[$ext]) {

                switch ($ext) {
                    case 'png':
                        $command = sprintf($this->args[$ext], escapeshellarg($file));
                        break;
                    case 'jpg':
                    case 'jpeg':
                        $command = sprintf($this->args[$ext], escapeshellarg($file), escapeshellarg($file . ".original"));
                        break;
                }
                if (!file_exists($file . ".original") && $command) {
                    copy($file, $file . ".original");
                    exec($handlers[$ext] . $command);
                }

            } else {
                echo "Не найден бинарный обработчик для файла: $file\n";
            }
        }
    }
}
