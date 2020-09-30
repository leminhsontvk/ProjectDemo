<?php


namespace Model;


use Core\Database;

class Contact
{
    private $Database;

    /**
     * User constructor.
     */
    public function __construct(string $UserName = NULL, string $UserMail = NULL, string $ContactSubject = NULL, string $ContactMessage = NULL)
    {
        $this -> Database = new Database();

        return $this -> AddContact($UserName, $UserMail, $ContactSubject, $ContactMessage);
    }

    public function AddContact(string $UserName, string $UserMail, string $ContactSubject, string $ContactMessage)
    {
        if ($_SESSION['UserID'] and $_SESSION['Logged'] === 1) $UserID = $_SESSION['UserID']; else $UserID = NULL;

        $SQL = "INSERT INTO ReceivedContact (UserName, UserMail, FromUserID, ContactSubject, ContactMessage) VALUE (?, ?, ?, ?, ?)";

        if ($UserID === NULL)
        {

        }

        return $this -> Database -> QExecute($SQL, $UserName, $UserMail, $UserID, $ContactSubject, $ContactMessage);
    }
}