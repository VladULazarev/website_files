<?php

namespace App\Models;

use Core\Model;
use PDO;

class PageData extends Model
{
    /**
     * Gets all needed data for the current page from the table 'main_links'
     * @param string $cellValue The value of the cell of the column 'link_url_name'
     */
    public function getPageData(string $cellValue)
    {
        $query = $this->connect()->query("SELECT
            link_h1,
            meta_title,
            meta_descr
              FROM $this->main_links_tb
            WHERE link_url_name='$cellValue'
        ");

        $data = $query->fetch(PDO::FETCH_OBJ);

        $this->checkIfDataExists($data);

        return $data;
    }
}
