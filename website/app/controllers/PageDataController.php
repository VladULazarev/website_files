<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\PageData;
use Core\Model;

class PageDataController extends Controller
{
  /**
   * Class 'PageDataController' sets 'meta title', 'meta description' and other needed data
   *  (see the current method) for the current webpage if they exist in the current DB table,
   *  and according to const 'ROUTE', const ROUTE is set in: core\Router.php
   *
   *  Usage:
   *
   *   $pageData = new App\Controllers\PageDataController();
   *   $data = $pageData->getData();
   *
   *   Set variables (optional):
   *   $metaTitle = $data->meta_title;
   *   $metaDescr  = $data->meta_descr;
   *
   *   or use as it is like so - $data->meta_title
   *
   *  Used in: @see the top part of /index.php
   *
   * @var Object $ata instance of PDOStatement
   */
    private $data;

    function __construct()
    {
        if (ROUTE[0] == 'home') {

            $cellValue = ROUTE[0];

            $modelObj = new PageData();
            $this->data = $modelObj->getPageData($cellValue);

        } elseif (ROUTE[0] == 'mainlink' || ROUTE[0] == 'account') {

            $cellValue = ROUTE[1];

            $modelObj = new PageData();
            $this->data = $modelObj->getPageData($cellValue);
        }
    }

    /**
     * @return Object $data All required data for the current webpage
     */
    public function getData()
    {
        return $this->data;
    }
}
