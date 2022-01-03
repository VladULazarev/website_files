<?php
/**
 * Simple autoloader that follow the PHP Standards Recommendation #0 (PSR-0)
 * @see https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md for more informations.
*/

function autoload($className)
{
    $className = ltrim($className, '\\');
    $path  = '';
    $namespace = '';
    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $path = str_replace('\\', DIRECTORY_SEPARATOR, strtolower($namespace)) . DIRECTORY_SEPARATOR;
    }

    $fullPath = $_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . $path . $className . '.php';

    // For debugging:
    //  echo $fullPath . '<br>';

    if (file_exists($fullPath)) {

        require_once $fullPath;

        return true;
    }

    echo "Class <b>{$fullPath}</b> was not found. <br>";
}

spl_autoload_register('autoload');
