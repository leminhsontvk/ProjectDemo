<?php


namespace Model;

use Core\Database;

class Info
{
    private $Database;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this -> Database = new Database();
    }

    public function GetSiteInfo()
    {
        return $this -> Database -> QSelectOneRecord('SELECT * FROM SiteInfo');
    }
}