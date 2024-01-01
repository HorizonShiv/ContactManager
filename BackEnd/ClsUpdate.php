<?php
require_once("DbConnect.php");

class Change{

    public $ContactID;
    public $ZeroValueField;
    public $ContactNumber;
    public function UpdateContact()
    {
        $conn = dbconnection();

        $sql = "UPDATE `UserContact` SET `$this->ZeroValueField`='$this->ContactNumber' WHERE `ContactID`=$this->ContactID";
        $result = $conn->query($sql);
        if ($result === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public $ContactName;
    public $ContactNumber1;
    public $ContactNumber2;
    public $ContactNumber3;
    public function UpdateContactFromEdit()
    {
        $conn = dbconnection();

        $sql = "UPDATE `UserContact` SET `ContactName`='$this->ContactName',`ContactNumber1`='$this->ContactNumber1',`ContactNumber2`='$this->ContactNumber2',`ContactNumber3`='$this->ContactNumber3' WHERE `ContactID`=$this->ContactID";
        $result = $conn->query($sql);
        if ($result === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}
?>