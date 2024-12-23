<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd7a28a44fe21d0f01e242b6a775ca205
{
    public static $files = array (
        '941748b3c8cae4466c827dfb5ca9602a' => __DIR__ . '/..' . '/rmccue/requests/library/Deprecated.php',
        '13906c19e3d8fcd1341b24ed4d51cf72' => __DIR__ . '/..' . '/razorpay/razorpay/Deprecated.php',
    );

    public static $prefixLengthsPsr4 = array (
        'a' => 
        array (
            'apimatic\\jsonmapper\\' => 20,
        ),
        'W' => 
        array (
            'WpOrg\\Requests\\' => 15,
        ),
        'U' => 
        array (
            'Unirest\\' => 8,
        ),
        'R' => 
        array (
            'Razorpay\\Tests\\' => 15,
            'Razorpay\\Api\\' => 13,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
            'PaypalServerSdkLib\\' => 19,
        ),
        'C' => 
        array (
            'Core\\' => 5,
            'CoreInterfaces\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'apimatic\\jsonmapper\\' => 
        array (
            0 => __DIR__ . '/..' . '/apimatic/jsonmapper/src',
        ),
        'WpOrg\\Requests\\' => 
        array (
            0 => __DIR__ . '/..' . '/rmccue/requests/src',
        ),
        'Unirest\\' => 
        array (
            0 => __DIR__ . '/..' . '/apimatic/unirest-php/src',
        ),
        'Razorpay\\Tests\\' => 
        array (
            0 => __DIR__ . '/..' . '/razorpay/razorpay/tests',
        ),
        'Razorpay\\Api\\' => 
        array (
            0 => __DIR__ . '/..' . '/razorpay/razorpay/src',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'PaypalServerSdkLib\\' => 
        array (
            0 => __DIR__ . '/..' . '/paypal/paypal-server-sdk/src',
        ),
        'Core\\' => 
        array (
            0 => __DIR__ . '/..' . '/apimatic/core/src',
        ),
        'CoreInterfaces\\' => 
        array (
            0 => __DIR__ . '/..' . '/apimatic/core-interfaces/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'R' => 
        array (
            'Rs\\Json' => 
            array (
                0 => __DIR__ . '/..' . '/php-jsonpointer/php-jsonpointer/src',
            ),
        ),
        'P' => 
        array (
            'PayPal' => 
            array (
                0 => __DIR__ . '/..' . '/paypal/rest-api-sdk-php/lib',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Requests' => __DIR__ . '/..' . '/rmccue/requests/library/Requests.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd7a28a44fe21d0f01e242b6a775ca205::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd7a28a44fe21d0f01e242b6a775ca205::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitd7a28a44fe21d0f01e242b6a775ca205::$prefixesPsr0;
            $loader->classMap = ComposerStaticInitd7a28a44fe21d0f01e242b6a775ca205::$classMap;

        }, null, ClassLoader::class);
    }
}
