<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1a005b20012f077bfd4d3bc9c9883012
{
    public static $prefixLengthsPsr4 = array (
        'b' => 
        array (
            'bheller\\ImagesGenerator\\' => 24,
        ),
        'F' => 
        array (
            'Faker\\' => 6,
        ),
        'A' => 
        array (
            'AyepsFaker\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'bheller\\ImagesGenerator\\' => 
        array (
            0 => __DIR__ . '/..' . '/bheller/images-generator/src',
        ),
        'Faker\\' => 
        array (
            0 => __DIR__ . '/..' . '/fzaninotto/faker/src/Faker',
        ),
        'AyepsFaker\\' => 
        array (
            0 => '/',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1a005b20012f077bfd4d3bc9c9883012::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1a005b20012f077bfd4d3bc9c9883012::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
