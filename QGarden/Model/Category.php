<?php


namespace Model;

use Core\Config;
use Core\Database;

class Category
{
    private $Database;

    public function __construct()
    {
        $this -> Database = new Database();
    }

    public function GetCategoryList(int $CategoryID = NULL)
    {
        if ($CategoryID !== NULL)
        {
            return $this -> Database -> QSelectOneRecord("SELECT * FROM Category WHERE CategoryID = ?", $CategoryID);
        } else return $this -> Database -> QSelect("SELECT * FROM Category");
    }
}