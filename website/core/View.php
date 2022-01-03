<?php

namespace Core;

use App\Controllers\ErrorController;

class View
{
    /**
     * Sends the current 'view' to the webpage
     *
     * @param string $path A part of the path to the current 'view'
     * @param Object $pageData instance of PDO Statement
     * @throws ErrorController if the current 'view' does not exists
     */
    public static function render(string $path, $pageData)
    {
        // For debugging
        if(!file_exists("app/views/{$path}.php")) {

            ErrorController::notFound();
        }

        include "app/views/{$path}.php";
    }
}
