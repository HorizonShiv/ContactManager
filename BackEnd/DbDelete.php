<?php
require_once("ClsDelete.php");

if (isset($_GET['TokenId']) && $_GET['TokenType']=='log') {
    echo $_GET['TokenId'];

    $objDelete = new Delete();
    $objDelete->Id = $_GET['TokenId'];
    $LogDelete = $objDelete->LogDelete();

    if ($LogDelete == true) {
        header("Location:../Export.php");
    } else {
        header("Location:../500.php");
    }
}elseif (isset($_GET['TokenId']) && $_GET['TokenType']=='contact') {
    echo $_GET['TokenId'];

    $objDelete = new Delete();
    $objDelete->Id = $_GET['TokenId'];
    $ContactDelete = $objDelete->ContactDelete();

    if ($ContactDelete == true) {
        header("Location:../Contact.php");
    } else {
        header("Location:../500.php");
    }
}
