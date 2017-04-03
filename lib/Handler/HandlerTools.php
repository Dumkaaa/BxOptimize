<?php


namespace Dumkaaa\BxOptimize\Handler;


class HandlerTools
{
    public static $handlers = [
        "win" => [
            "gif" => "gifsicle.exe",
            "png" => "optipng.exe",
            "jpg" =>  "jpegtran.exe",
            "pngquant" => "pngquant.exe",
            "webp" => "cwebp.exe",
        ],
        "darwin" => [
            "gif" => "gifsicle-mac",
            "png" => "optipng-mac",
            "jpg" =>  "jpegtran-mac",
            "jpeg" =>  "jpegtran-mac",
            "pngquant" => "pngquant-mac",
            "webp" => "cwebp-mac9",
        ],
        "sunos" => [
            "gif" => "gifsicle-sol",
            "png" => "optipng-sol",
            "jpg" =>  "jpegtran-sol",
            "jpeg" =>  "jpegtran-sol",
            "pngquant" => "pngquant-sol",
            "webp" => "cwebp-sol",
        ],
        "freebsd" =>[
            "gif" => "gifsicle-fbsd",
            "png" => "optipng-fbsd",
            "jpg" =>  "jpegtran-fbsd",
            "jpeg" =>  "jpegtran-fbsd",
            "pngquant" => "pngquant-fbsd",
            "webp" => "cwebp-fbsd",
        ],
        "linux" => [
            "gif" => "gifsicle-linux",
            "png" => "optipng-linux",
            "jpg" =>  "jpegtran-linux",
            "jpeg" =>  "jpegtran-linux",
            "pngquant" => "pngquant-linux",
            "webp" => "cwebp-linux",
        ],
    ];

    public static function getBinaryHandler($type){

        $handlers = self::getBinaryHandlers();

        $handlerPath = dirname(dirname(__DIR__)) . '/bin/';

        return isset($handlers[$type]) ? $handlerPath . $handlers[$type] : false;

    }

    public static function getBinaryHandlers(){

        $os = strtolower(PHP_OS);
        if (substr($os, 0, 3) == "win") {
            $os = "win";
        }

        return isset(self::$handlers[$os]) ? self::$handlers[$os] : [];
    }

}