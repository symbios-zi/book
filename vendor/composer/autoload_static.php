<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4a8090b6fcfdfe51895cc0413dac7899
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/App',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4a8090b6fcfdfe51895cc0413dac7899::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4a8090b6fcfdfe51895cc0413dac7899::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit4a8090b6fcfdfe51895cc0413dac7899::$classMap;

        }, null, ClassLoader::class);
    }
}
