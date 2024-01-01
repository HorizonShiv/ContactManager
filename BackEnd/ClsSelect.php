<?php
require_once("DbConnect.php");


//Get all Information
class Login
{
    public $UserId;
    public $UserPassword;
    public function UserLogin()
    {
        $conn = dbconnection();

        $sql = "SELECT * FROM `User` WHERE `UserID`='$this->UserId' AND `UserPassword`='$this->UserPassword'";
        $result = $conn->query($sql);


        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $_SESSION['UserName'] = $row['UserName'];
            }
            return true;
        } else {
            return false;
        }
    }
}

class Get
{
    public $Number;
    public function CheckNumber()
    {
        $conn = dbconnection();

        $sql = "SELECT `ContactID`,`ContactName`,
                    CASE
                        WHEN `ContactNumber1` IN ('$this->Number') THEN 'ContactNumber1'
                        WHEN `ContactNumber2` IN ('$this->Number') THEN 'ContactNumber2'
                        WHEN `ContactNumber3` IN ('$this->Number') THEN 'ContactNumber3'
                        ELSE 'Not Found'
                    END AS FoundInField
                FROM UserContact
                WHERE (`ContactNumber1` IN ('$this->Number'))
                OR (`ContactNumber2` IN ('$this->Number'))
                OR (`ContactNumber3` IN ('$this->Number'));";
        $result = $conn->query($sql);


        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }

    public $ContactID;
    public function CheckField()
    {
        $conn = dbconnection();

        $sql = "SELECT *,
                        CASE
                            WHEN `ContactNumber1` = 0 THEN 'ContactNumber1'
                            WHEN `ContactNumber2` = 0 THEN 'ContactNumber2'
                            WHEN `ContactNumber3` = 0 THEN 'ContactNumber3'
                            ELSE 'No zero value'
                        END AS ZeroValueField
                FROM UserContact
                WHERE ContactID = $this->ContactID;";
        $result = $conn->query($sql);


        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }

    public function GetContact()
    {
        $conn = dbconnection();

        $sql = "SELECT * FROM `UserContact` ORDER BY ContactID DESC";
        $result = $conn->query($sql);


        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }

    public function GetContactById()
    {
        $conn = dbconnection();

        $sql = "SELECT * FROM `UserContact` WHERE ContactID='$this->ContactID'";
        $result = $conn->query($sql);


        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }

    public function GetContactASC()
    {
        $conn = dbconnection();

        $sql = "SELECT * FROM `UserContact` ORDER BY ContactName ASC";
        $result = $conn->query($sql);


        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }

    public function GetContactCount()
    {
        $conn = dbconnection();

        $sql = "SELECT COUNT(ContactID) AS ContactCount FROM UserContact";
        $result = $conn->query($sql);
        return $result;
    }

    public function GetContactLog()
    {
        $conn = dbconnection();

        // $sql = "SELECT * FROM `ContactLog` WHERE 1";
        $sql = "SELECT * FROM `ContactLog` ORDER BY `LogID` DESC";
        $result = $conn->query($sql);
        return $result;
    }

    public $Id;
    public function GetContactLogById()
    {
        $conn = dbconnection();

        // $sql = "SELECT * FROM `ContactLog` WHERE 1";
        $sql = "SELECT * FROM `ContactLog` WHERE `LogID`=$this->Id";
        $result = $conn->query($sql);
        return $result;
    }


    public $FromData;
    public $FromTime;
    public $ToData;
    public $ToTime;
    public function GetContactByDate()
    {
        $conn = dbconnection();

        $sql = "SELECT
                    *
                FROM
                    `UserContact`
                WHERE
                    (`Date` BETWEEN '$this->FromData' AND '$this->ToData') AND (`Time` BETWEEN '$this->FromTime' AND '$this->ToTime')";
        $result = $conn->query($sql);
        return $result;
    }
}
