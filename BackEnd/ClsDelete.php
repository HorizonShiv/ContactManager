<?php
require_once("DbConnect.php");


//Get all Information
class Delete
{
    public $Id;
    public function LogDelete()
    {
        $conn = dbconnection();

        $sql = "DELETE FROM `ContactLog` WHERE `LogID`='$this->Id'";
        $result = $conn->query($sql);
        if ($result === TRUE) {
            return true;
        } else {
            return false;
        }
    }
    public function ContactDelete()
    {
        $conn = dbconnection();

        $sql = "DELETE FROM `UserContact` WHERE `ContactID`='$this->Id'";
        $result = $conn->query($sql);
        if ($result === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}