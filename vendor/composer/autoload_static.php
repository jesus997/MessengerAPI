<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite46b6ad87d8e38c4b78078059b1e09fe
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Component\\Yaml\\' => 23,
        ),
        'P' => 
        array (
            'Phroute\\Phroute\\' => 16,
            'PHLAK\\Config\\' => 13,
        ),
        'J' => 
        array (
            'JessHilario\\Chatear\\Model\\' => 26,
            'JessHilario\\Chatear\\Controller\\' => 31,
            'JessHilario\\Chatear\\Config\\' => 27,
            'JessHilario\\Chatear\\App\\' => 24,
        ),
        'F' => 
        array (
            'FontLib\\' => 8,
        ),
        'D' => 
        array (
            'Dompdf\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Component\\Yaml\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/yaml',
        ),
        'Phroute\\Phroute\\' => 
        array (
            0 => __DIR__ . '/..' . '/phroute/phroute/src/Phroute',
        ),
        'PHLAK\\Config\\' => 
        array (
            0 => __DIR__ . '/..' . '/phlak/config/src',
        ),
        'JessHilario\\Chatear\\Model\\' => 
        array (
            0 => __DIR__ . '/../..' . '/models',
        ),
        'JessHilario\\Chatear\\Controller\\' => 
        array (
            0 => __DIR__ . '/../..' . '/controllers',
        ),
        'JessHilario\\Chatear\\Config\\' => 
        array (
            0 => __DIR__ . '/../..' . '/config',
        ),
        'JessHilario\\Chatear\\App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
        'FontLib\\' => 
        array (
            0 => __DIR__ . '/..' . '/phenx/php-font-lib/src/FontLib',
        ),
        'Dompdf\\' => 
        array (
            0 => __DIR__ . '/..' . '/dompdf/dompdf/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'S' => 
        array (
            'Svg\\' => 
            array (
                0 => __DIR__ . '/..' . '/phenx/php-svg-lib/src',
            ),
            'Sabberworm\\CSS' => 
            array (
                0 => __DIR__ . '/..' . '/sabberworm/php-css-parser/lib',
            ),
        ),
    );

    public static $classMap = array (
        'Cpdf' => __DIR__ . '/..' . '/dompdf/dompdf/lib/Cpdf.php',
        'HTML5_Data' => __DIR__ . '/..' . '/dompdf/dompdf/lib/html5lib/Data.php',
        'HTML5_InputStream' => __DIR__ . '/..' . '/dompdf/dompdf/lib/html5lib/InputStream.php',
        'HTML5_Parser' => __DIR__ . '/..' . '/dompdf/dompdf/lib/html5lib/Parser.php',
        'HTML5_Tokenizer' => __DIR__ . '/..' . '/dompdf/dompdf/lib/html5lib/Tokenizer.php',
        'HTML5_TreeBuilder' => __DIR__ . '/..' . '/dompdf/dompdf/lib/html5lib/TreeBuilder.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite46b6ad87d8e38c4b78078059b1e09fe::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite46b6ad87d8e38c4b78078059b1e09fe::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInite46b6ad87d8e38c4b78078059b1e09fe::$prefixesPsr0;
            $loader->classMap = ComposerStaticInite46b6ad87d8e38c4b78078059b1e09fe::$classMap;

        }, null, ClassLoader::class);
    }
}
