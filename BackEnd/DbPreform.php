<?php
session_start();
require_once("ClsSelect.php");
require_once("ClsUpdate.php");
require_once("ClsInsert.php");

if (isset($_POST['UpdateOldContact'])) {
    echo 'UpdateOldContact<br>';
    if (isset($_POST['ChosenName'])) {
        $TempName = explode('&', $_POST['ChosenName']);

        echo $TempName[0].'<br>';
        echo end($TempName) . '<br>';

        $objGet = new Get();
        $objGet->ContactID = end($TempName);
        $CheckField = $objGet->CheckField();


        if ($CheckField->num_rows > 0) {
            foreach ($CheckField as $row) {
                $ZeroValueField = $row['ZeroValueField'];
                break;
            }
        }
        echo $ZeroValueField;

        if($ZeroValueField!='No zero value'){
            echo '<pre>';
            print_r($_SESSION['NotExistNo']);
            echo '</pre>';
    
            $objUpdate = new Change();
            $objUpdate->ContactID = end($TempName);
            $objUpdate->ZeroValueField = $ZeroValueField;
            $objUpdate->ContactNumber = $_SESSION['NotExistNo'][0];
            $UpdateContact = $objUpdate->UpdateContact();
    
            if ($UpdateContact == true) {
                $_SESSION['Done']=true;
                header('Location:../index.php');
            } else {
                header('Location:../500.php');
            }
        }
        else{
            $_SESSION['Max']=true;
            header('Location:../index.php');
        }


    } else {
        $tempCount=0;
        for ($i = 0; $i < count($_SESSION['NotExistNo']); $i++) {
            $objGet = new Get();
            $objGet->ContactID = $_SESSION['ExistID'][0];
            $CheckField = $objGet->CheckField();

            if ($CheckField->num_rows > 0) {
                foreach ($CheckField as $row) {
                    $ZeroValueField = $row['ZeroValueField'];
                    break;
                }
            }

            if($ZeroValueField!='No zero value'){
                $objUpdate = new Change();
                $objUpdate->ContactID =  $_SESSION['ExistID'][0];
                $objUpdate->ZeroValueField = $ZeroValueField;
                $objUpdate->ContactNumber = $_SESSION['NotExistNo'][$i];
                $UpdateContact = $objUpdate->UpdateContact();

                if ($UpdateContact == true) {
                    $tempCount++;
                } else {
                    header('Location:../500.php');
                }

                if($tempCount==count($_SESSION['NotExistNo'])){
                    $_SESSION['Done']=true;
                    header('Location:../index.php');
                }
            }
            else{
                $_SESSION['Max']=true;
                header('Location:../index.php');
            }
               
        }
    }
} elseif (isset($_POST['CreateNewContact'])) {
    echo 'CreateNewContact<br>';

    if(isset($_POST['UserName'])==True){
        echo $_POST['UserName'];

        echo '<pre>';
        print_r($_SESSION['NotExistNo']);
        echo '</pre>';

        date_default_timezone_set("Asia/Calcutta");
        $UserTime = date('H:i:s');
        $UserDate = date('Y-m-d');

        if($_SESSION['NotExistNo'][0]==""){
            $ContactNumber1=0;
        }else{
            $ContactNumber1=$_SESSION['NotExistNo'][0];
        }
        if($_SESSION['NotExistNo'][1]==""){
            $ContactNumber2=0;
        }else{
            $ContactNumber2=$_SESSION['NotExistNo'][1];
        }
        if($_SESSION['NotExistNo'][2]==""){
            $ContactNumber3=0;
        }else{
            $ContactNumber3=$_SESSION['NotExistNo'][2];
        }

        $objInsert = new Add();
        $objInsert->ContactName = $_POST['UserName'];
        $objInsert->ContactNumber1 = $ContactNumber1;
        $objInsert->ContactNumber2 = $ContactNumber2;
        $objInsert->ContactNumber3 = $ContactNumber3;
        $objInsert->Date = $UserDate;
        $objInsert->Time = $UserTime;
        $AddUserContact = $objInsert->AddUserContact();

        if($AddUserContact==true){
            $_SESSION['Done']=True;
            header('Location:../index.php');
        }
        else{
            header('Location:../500.php');
        }
    }
}
else{
    header('Location:../500.php');
}
