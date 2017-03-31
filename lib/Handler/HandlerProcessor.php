<?php

namespace Dumkaaa\BxOptimize\Handler;

class HandlerProcessor
{
    /** @var array Стандартные обработчики */
    private $defaultHandlers = [
        'image' => __NAMESPACE__.'\ImageHandler',
        //'css' => __NAMESPACE__ . '\CssHandler',
    ];

    /** @var array Включенные обработчики */
    protected $handlers = [];

    /**
     * Включаем либо обработчики из переданного набора, либо все стандартные.
     *
     * @param array $handlers
     */
    public function __construct(array $handlers)
    {
        is_array($handlers)
            ? $this->enableHandlers($handlers)
            : $this->enableHandlers($this->defaultHandlers);
    }

    /**
     * Включает обработчики из массива.
     *
     * @param array $handlers
     */
    public function enableHandlers(array $handlers)
    {
        //убираем возможные дубликаты
        $handlers = array_unique(array_map('strtolower', $handlers));

        //включаем
        foreach ($handlers as $handler) {
            $this->enableHandler($handler);
        }
    }

    /**
     * Включает обработчик из списка доступных обработчиков.
     *
     * @param string $key Ключ-имя обработчика
     *
     * @throws \Exception
     */
    public function enableHandler($key)
    {
        if (!$key) {
            throw new \Exception('Не передан ключ обработчика');
        } else {
            $key = strtolower(trim($key));
        }

        if (isset($this->defaultHandlers[$key])) {
            $this->handlers[$key] = new $this->defaultHandlers[$key]();
        } else {
            throw new \Exception("Обработчик $key не найден");
        }
    }

    /**
     * Возврашает включенные обработчики.
     *
     * @return array
     */
    public function getHandlers()
    {
        return $this->handlers;
    }

    /**
     * Добавляет новый обработчик и сразу включает его.
     *
     * @param string $key       Ключ-имя обработчика
     * @param string $classname Класс обработчика
     * @param bool   $replace   Заменять, если уже есть такой обработчик
     *
     * @return bool
     */
    public function addHandler($key, $classname, $replace = false)
    {
        $return = false;

        if (!isset($this->handlers[$key]) || $replace) {
            $this->handlers[$key] = new $classname();
            $return = true;
        }

        return $return;
    }
}
