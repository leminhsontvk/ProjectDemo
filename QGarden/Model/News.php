<?php


namespace Model;

use Core\Core;
use Core\Config;
use Core\Database;

class News
{
    private $Database;

    /**
     * Construct function
     */
    public function __construct()
    {
        $this -> Database = new Database();
    }

    public function GetNewsList(int $CurrentPage = 0)
    {
        $SQL = "SELECT NewsID, NewsTitle, NewsPreview, NewsContent, NewsDefaultImage, NewsCreateDate, NewsCreateByUserID, NewsTotalComment, UserName FROM News, Users WHERE UserID = NewsCreateByUserID GROUP BY NewsID";

        if ($CurrentPage != 0)
        {
            $SQL .= " LIMIT ".($CurrentPage - 1) * Config::ProductPerPage.", ".Config::ProductPerPage;

            return $this -> Database -> QSelect($SQL, $CurrentPage);
        }

        return $this -> Database -> QSelect($SQL);
    }

    public function GetNewsInfo(int $NewsID)
    {
        $SQL = "SELECT NewsID, NewsTitle, NewsPreview, NewsContent, NewsDefaultImage, NewsCreateDate, NewsCreateByUserID, NewsTotalComment, UserName FROM News, Users WHERE UserID = NewsCreateByUserID AND NewsID = ? GROUP BY NewsID";

        Core::LogFile('','', get_defined_vars());
        return $this -> Database -> QSelectOneRecord($SQL, $NewsID);
    }

    public function GetTotalNews()
    {
        return (int)($this -> Database -> QSelectOneValue("SELECT COUNT(*) FROM News"));
    }
}