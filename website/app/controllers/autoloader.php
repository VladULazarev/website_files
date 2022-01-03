<?php
/**
 * loads all needed classes
 *
 * @param $className Name of the class
 *
 * @throws $message if a class was not found
 */

spl_autoload_register('classAutoLoader');

function classAutoLoader($className) {

			 $className = ltrim($className, '\\');
	     $path  = '';
	     $namespace = '';
	     if ($lastNsPos = strrpos($className, '\\')) {
	         $namespace = substr($className, 0, $lastNsPos);
	         $className = substr($className, $lastNsPos + 1);
	         $path = str_replace('\\', DIRECTORY_SEPARATOR, strtolower($namespace)) . DIRECTORY_SEPARATOR;
	     }

	     $fullPath = $_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . $path . $className . '.php';


			// * For debugging:
			// echo $fullPath . '<br>';

			$message = "Class <b>{$className}</b> was not found. <br>";

			if(!file_exists($fullPath)) {

			    echo $message;
			    return false;
			}

			require_once $fullPath;
	}
