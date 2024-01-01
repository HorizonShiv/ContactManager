<?php 

require_once("DbConnect.php");

// Add All Data
class Add
{
    public $ContactName;
    public $ContactNumber1;
    public $ContactNumber2;
    public $ContactNumber3;
    public $Date;
    public $Time;
    public function AddUserContact()
    {
        $conn = dbconnection();
        $sql = "INSERT INTO `UserContact`(`ContactName`, `ContactNumber1`, `ContactNumber2`, `ContactNumber3`, `Date`, `Time`) VALUES ('$this->ContactName','$this->ContactNumber1','$this->ContactNumber2','$this->ContactNumber3','$this->Date','$this->Time')";

        $result = $conn->query($sql);


        if ($result === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public $FileName;
    public $FileType;
    public $LogFromDate;
    public $LogFromTime;
    public $LogToDate;
    public $LogToTime;
    public $LogCurrentDate;
    public $LogCurrentTime;
    public function AddContactLog()
    {
        $conn = dbconnection();
        $sql = "INSERT INTO `ContactLog`(`FileName`,`FileType`, `LogFromDate`, `LogFromTime`, `LogToDate`, `LogToTime`, `LogCurrentDate`, `LogCurrentTime`) VALUES ('$this->FileName','$this->FileType','$this->LogFromDate','$this->LogFromTime','$this->LogToDate','$this->LogToTime','$this->LogCurrentDate','$this->LogCurrentTime')";

        $result = $conn->query($sql);


        if ($result === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function AddContactLogNull()
    {
        $conn = dbconnection();
        $sql = "INSERT INTO `ContactLog`(`FileName`,`FileType`, `LogToDate`, `LogToTime`, `LogCurrentDate`, `LogCurrentTime`) VALUES ('$this->FileName','$this->FileType','$this->LogToDate','$this->LogToTime','$this->LogCurrentDate','$this->LogCurrentTime')";

        $result = $conn->query($sql);


        if ($result === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}