<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9d14721cb2c79659b69421f0f587f4ee
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit9d14721cb2c79659b69421f0f587f4ee::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9d14721cb2c79659b69421f0f587f4ee::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit9d14721cb2c79659b69421f0f587f4ee::$classMap;

        }, null, ClassLoader::class);
    }
}
