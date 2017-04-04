# BxOptimize

Библиотека под 1C-Битрикс для оптимизации и сжатия картинок, стилей, скриптов  прочей статики.

[![Latest Stable Version](https://poser.pugx.org/dumkaaa/bxoptimize/v/stable)](https://packagist.org/packages/dumkaaa/bxoptimize)
[![Latest Unstable Version](https://poser.pugx.org/dumkaaa/bxoptimize/v/unstable)](https://packagist.org/packages/dumkaaa/bxoptimize)
[![PHP version](https://badge.fury.io/ph/dumkaaa%2Fbxoptimize.svg)](https://badge.fury.io/ph/dumkaaa%2Fbxoptimize)
[![Dependency Status](https://gemnasium.com/badges/github.com/Dumkaaa/BxOptimize.svg)](https://gemnasium.com/github.com/Dumkaaa/BxOptimize)

Позволяет сжимать и оптимизировать размер файлов картинок (`png, jpg, gif, webp`), стилей (`css`) и скриптов (`js`).

При этом оригинальные файлы сохраняются рядом с измененным в виде `file.png > file.png.original` для возможности восстановления.

## Установка

```bash
composer require dumkaaa/bxoptimize
composer run-script post-install-cmd -d ./vendor/dumkaaa/bxoptimize
```
## Базовое использование

* Запуск из PHP

    ```php
    $path = 'path/to/dir'; // пусть к папке для поиска файлов (обязательный)
    $finder = new \Dumkaaa\BxOptimize\Finder\FilesFinder($path);
    
    $handlers = [ //массив обработчиков (необязательный, по умолчанию - все)
        'image',
        'css',
    ]; 
    $handler = new \Dumkaaa\BxOptimize\Handler\HandlerProcessor($handlers);
    
    $optimizer = new \Dumkaaa\BxOptimize\Optimizer($finder, $handler);
    $optimizer->optimize();
    ```

* Запуск из консоли
    
    ```bash
    php path/to/vendor/bin/bxoptimize bxoptimize:optimize path/to/dir [<image css js>]
    ```
    Параметры:
    `path/to/dir` - пусть к папке для поиска файлов (обязательный)
    `[<images css js>]` - массив обработчиков (необязательный, по умолчанию - все)

* Запуск из cli
    * В файл cli.php добавить строку:
        ```php
        $application->add(new \Dumkaaa\BxOptimize\Cli\SymfonyOptimize());
        ```
    
    * Запуск:
        ```bash
        php cli.php bxoptimize:optimize path/to/dir [<image css js>]
        ```
## Расширенное использование

Можно подключать свои обработчики или заменять стандартные. При этом класс обработчика должен наследоваться 
от `Dumkaaa\BxOptimize\Handler\Handler` или реализовывать интерфейс `Dumkaaa\BxOptimize\Handler\HandlerInterface`.

Кастомные обработчики должны быть добавлены в массив обработчиков ($handlers) 
перед запуском или вызовом метода `addHandler($key, $classname, $replace = false)` 
класса `Dumkaaa\BxOptimize\Handler\HandlerProcessor`

```php
    $handler->addHandler('css', '\\My\\Custom\\Handler\\CssHandler');
```

## Badges

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Dumkaaa/BxOptimize/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Dumkaaa/BxOptimize/?branch=master)
[![StyleCI](https://styleci.io/repos/86715035/shield?branch=master)](https://styleci.io/repos/86715035)
[![Code Climate](https://codeclimate.com/github/Dumkaaa/BxOptimize/badges/gpa.svg)](https://codeclimate.com/github/Dumkaaa/BxOptimize)
[![Issue Count](https://codeclimate.com/github/Dumkaaa/BxOptimize/badges/issue_count.svg)](https://codeclimate.com/github/Dumkaaa/BxOptimize)

[![Build Status](https://scrutinizer-ci.com/g/Dumkaaa/BxOptimize/badges/build.png?b=master)](https://scrutinizer-ci.com/g/Dumkaaa/BxOptimize/build-status/master)
[![Code Coverage](https://scrutinizer-ci.com/g/Dumkaaa/BxOptimize/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Dumkaaa/BxOptimize/?branch=master)

[![License](https://poser.pugx.org/dumkaaa/bxoptimize/license)](https://packagist.org/packages/dumkaaa/bxoptimize)
[![PHPPackages Rank](http://phppackages.org/p/dumkaaa/bxoptimize/badge/rank.svg)](http://phppackages.org/p/dumkaaa/bxoptimize)

[![composer.lock](https://poser.pugx.org/dumkaaa/bxoptimize/composerlock)](https://packagist.org/packages/dumkaaa/bxoptimize)
