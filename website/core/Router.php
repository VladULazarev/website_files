<?php

namespace Core;

use App\Controllers\ErrorController;

class Router
{
    use Validator;

    /**
     * Set the constant 'ROUTE'
     */
    const ROUTE = [];

    /**
     * Defines the constant 'ROUTE' and its array from $_SERVER['REQUEST_URI']
     *
     * Constant 'ROUTE' determines the foloowing routes:
     *
     * ROUTE['home']
     * ROUTE['mainlink', 'name of main link'] (name of main link: blog, contact-us, site-map and so on...
     * ROUTE['mainlink', 'account']
     *
     * Method checkUriPart() from 'Validator' is used to check if $uriPart has 'bad' symbols or not
     *
     * @return array constant 'ROUTE' for the current webpage
     * @throws ErrorController if $uriParts does not match
     */
    public static function getRoute(): array
    {

        $uriParts = explode('/', $_SERVER['REQUEST_URI']);

        if(!$uriParts[1]) {

            /**
             * It means we have the following uri: http://domainname.com
             */
            define('ROUTE', ['home']);

        } elseif ($uriParts[1] == 'account' && !$uriParts[2]) {

            /**
             * It means we have the following uri: http://domainname.com/account
             */

            if(!self::checkUriPart($uriParts[1]))   {

                return ErrorController::notFound();

            }

            define('ROUTE', ['account', $uriParts[1]]);

        } elseif ($uriParts[1] && !$uriParts[2]) {

            /**
             * It means we have the following uri:
             * http://domainname.com/blog or /contact-us and so on...
             */

            if(!self::checkUriPart($uriParts[1]))   {

                return ErrorController::notFound();

            }

            define('ROUTE', ['mainlink', $uriParts[1]]);

        } else {

            /**
             * If something wrong is happening
             */
            return ErrorController::notFound();
        }

        return ROUTE;
    }
}
