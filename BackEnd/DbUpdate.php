<?php 
session_start();
require_once("ClsUpdate.php");

if(isset($_POST['ContactModify'])){

    echo $_POST['UserName'].'<br>';

    if ($_POST['Number'][0] == "") {
        $ContactNumber1 = 0;
    } else {
        $ContactNumber1 = $_POST['Code'][0].$_POST['Number'][0];
    }

    if ($_POST['Number'][1] == "") {
        $ContactNumber2 = 0;
    } else {
        $ContactNumber2 = $_POST['Code'][1].$_POST['Number'][1];
    }

    if ($_POST['Number'][2] == "") {
        $ContactNumber3 = 0;
    } else {
        $ContactNumber3 = $_POST['Code'][2].$_POST['Number'][2];
    }

    echo $ContactNumber1.'<br>';
    echo $ContactNumber2.'<br>';
    echo $ContactNumber3.'<br>';

    $obj = new Change();
    $obj->ContactID = $_SESSION['ContactID'];
    $obj->ContactName = $_POST['UserName'];
    $obj->ContactNumber1 = $ContactNumber1;
    $obj->ContactNumber2 = $ContactNumber2;
    $obj->ContactNumber3 = $ContactNumber3;
	$UpdateContactFromEdit = $obj->UpdateContactFromEdit();

    if($UpdateContactFromEdit==True){
        header('Location:../Contact.php');
    }
    else{
        header('Location:../500.php');
    }
}

?>