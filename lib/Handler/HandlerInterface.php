<?php


namespace Dumkaaa\BxOptimize\Handler;


interface HandlerInterface
{
    /**
     * Проверяет, можно ли данный обработчик обработать этот файл
     * @param string $file Путь к файлу
     * @return bool
     * @throws \Exception
     */
    public function canHandleFile($file);

    /**
     * Записывает файл в очередь на обработку
     * @param string $file Путь к файлу
     * @return void
     */
     function queueFile($file);

    /**
     * Обрабатывает файлы в очереди
     * @return mixed
     */
    public function handleQueue();

}