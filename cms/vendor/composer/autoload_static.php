<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit39ebcf9c667b6b66a3756858b1439efb
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Component\\Yaml\\' => 23,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Component\\Yaml\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/yaml',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit39ebcf9c667b6b66a3756858b1439efb::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit39ebcf9c667b6b66a3756858b1439efb::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
