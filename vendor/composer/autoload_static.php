<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd4d3a53b957422963df422cf78dc4c15
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Models\\' => 7,
        ),
        'C' => 
        array (
            'Controllers\\' => 12,
        ),
        'A' => 
        array (
            'Application\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Models\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Models',
        ),
        'Controllers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Controllers',
        ),
        'Application\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Application',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd4d3a53b957422963df422cf78dc4c15::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd4d3a53b957422963df422cf78dc4c15::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
