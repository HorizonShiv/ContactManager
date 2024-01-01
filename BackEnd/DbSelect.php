<?php 
session_start();
require_once("ClsSelect.php");

if(isset($_POST['Login'])){
    $UserId=md5($_POST['UserId']);
    $UserPassword=md5($_POST['Password']);
    
    echo $UserId.'<br>';
    echo $UserPassword;

    $obj = new Login();
    $obj->UserId = $UserId;
    $obj->UserPassword = $UserPassword;
	$UserLogin = $obj->UserLogin();

    if ($UserLogin == true) {
		$_SESSION['Login'] = TRUE;
		header('Location:../');
	} else {
        $_SESSION['LoginErr']=true;
		header('Location:../');
	}
}
?>