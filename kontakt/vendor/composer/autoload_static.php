<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9f04bc2994bb444956023c362fd9c0e4
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

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit9f04bc2994bb444956023c362fd9c0e4::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9f04bc2994bb444956023c362fd9c0e4::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
