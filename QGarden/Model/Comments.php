<?php


namespace Model;

use Core\Core;
use Core\Config;
use Core\Database;

class Comments extends Config
{
    private $Database;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this -> Database = new Database();
    }

    public function GetUserAvatar(int $UserID)
    {
        $SQL = "SELECT UserAvatar FROM Users WHERE UserID = ?";
        return $this -> Database -> QSelectOneValue($SQL, $UserID);
    }

    public function GetUserName(int $UserID)
    {
        $SQL = "SELECT UserName FROM Users WHERE UserID = ?";
        return $this -> Database -> QSelectOneValue($SQL, $UserID);
    }

    /**
     * Get comment from given type with subject id.
     * @param int $Type Query type. 1: Comment on product. 2: Comment on news. 3: Reply on comment.
     * @param int $SubjectID ID mach each type.
     * @return array|bool|string Return comment list as array if success false if error. Error Message if DebugMode true.
     */
    public function GetComment(int $Type, int $SubjectID)
    {
        switch ($Type)
        {
            case 1:
                $SQL = "SELECT * FROM Comments WHERE CommentOnProductID = ?";
                break;
            case 2:
                $SQL = "SELECT * FROM Comments WHERE CommentOnNewsID = ?";
                break;
            case 3:
                $SQL = "SELECT * FROM Comments WHERE CommentReplyOnID = ?";
                break;
        } return $this -> Database -> QSelect($SQL, $SubjectID);
    }

    public function AddComment(int $Type, int $SubjectID, string $Content, int $Star = NULL)
    {
        switch ($Type)
        {
            case 1:
                $SQL = "INSERT INTO Comments (CommentOnProductID, CommentOfUserID, CommentRatedStar, CommentContent, CommentCreatedDate) VALUE (?, ?, ?, ?, ".time().")";
                return $this -> Database -> QExecute($SQL, $SubjectID, $_SESSION['UserID'], $Star, $Content);
                break;
            case 2:
                $SQL = "INSERT INTO Comments (CommentOnNewsID, CommentOfUserID, CommentContent, CommentCreatedDate) VALUE (?, ?, ?, ".time().")";
                return $this -> Database -> QExecute($SQL, $SubjectID, $_SESSION['UserID'], $Content);
                break;
            case 3:
                $SQL = "INSERT INTO Comments (CommentReplyOnID, CommentOfUserID, CommentContent, CommentCreatedDate) VALUE (?, ?, ?, ".time().")";
                return $this -> Database -> QExecute($SQL, $SubjectID, $_SESSION['UserID'], $Content);
                break;
        }
    }
}