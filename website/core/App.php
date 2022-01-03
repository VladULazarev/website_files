<?php

namespace Core;

class App
{
    /**
     * Starts the Application
     *
     *  Usage:
     *    Core\App::run();
     * @see /index.php
     */
    public static function run($pageData)
    {

        // Loads 'view' according to 'ROUTE[0]', see Core\Router.pnp
        if (ROUTE[0] == "mainlink") {

            // Example: Current uri: http://domain.com/blog
            // Path to view is: $path = "mainlink/blog-page-content"
            // or
            // Example: Current uri: http://domain.com/contact-us
            // Path to view is: $path = "mainlink/contact-us-page-content"
            $path = ROUTE[0] . "/" . ROUTE[1] . "-page-content";
            View::render($path, $pageData);

        } elseif (ROUTE[0] == "account") {

            // Example: Current uri: http://domain.com/account
            // Path to view is: $path = "account/account-page-content"
            $path = ROUTE[0] . "/" . ROUTE[1] . "-page-content";
            View::render($path, $pageData);

        } else {

            // Example: current uri: http://domain.com/
            // ROUTE[0] = 'home'
            // Path to view is: $path = "home/home-page-content"
            $path = ROUTE[0] . "/" . ROUTE[0] . "-page-content";
            View::render($path, $pageData);
        }
    }
}
