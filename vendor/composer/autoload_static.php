<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7c45aa6f8d74dd7c5e55bbda8b2cdf75
{
    public static $prefixLengthsPsr4 = array (
        'V' => 
        array (
            'Vendor\\Package\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Vendor\\Package\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7c45aa6f8d74dd7c5e55bbda8b2cdf75::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7c45aa6f8d74dd7c5e55bbda8b2cdf75::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit7c45aa6f8d74dd7c5e55bbda8b2cdf75::$classMap;

        }, null, ClassLoader::class);
    }
}