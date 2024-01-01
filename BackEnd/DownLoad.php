<?php
require_once("ClsSelect.php");
require_once("ClsInsert.php");

require '../vendor/autoload.php';
date_default_timezone_set("Asia/Calcutta");

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$obj = new Get();

$file = new Spreadsheet();

if (isset($_GET['BasicExcel'])) {

    $GetContact  = $obj->GetContactASC();

    $fileName = 'Contact' . date('dmY') . '.Xlsx';


    $activeWorksheet = $file->getActiveSheet();
    $activeWorksheet->setCellValue('A1', 'UserName');
    $activeWorksheet->setCellValue('B1', 'Contact1');
    $activeWorksheet->setCellValue('C1', 'Contact2');
    $activeWorksheet->setCellValue('D1', 'Contact3');

    $tempCount = 2;
    if ($GetContact->num_rows > 0) {
        foreach ($GetContact as $row) {

            if ($row['ContactNumber1'] == 0) {
                $ContactNumber1 = "";
            } else {
                $ContactNumber1 = $row['ContactNumber1'];
            }
            if ($row['ContactNumber2'] == 0) {
                $ContactNumber2 = "";
            } else {
                $ContactNumber2 = $row['ContactNumber2'];
            }
            if ($row['ContactNumber3'] == 0) {
                $ContactNumber3 = "";
            } else {
                $ContactNumber3 = $row['ContactNumber3'];
            }

            $activeWorksheet->setCellValue('A' . $tempCount, $row['ContactName']);
            $activeWorksheet->setCellValueExplicit('B' . $tempCount, $ContactNumber1, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $activeWorksheet->setCellValueExplicit('C' . $tempCount, $ContactNumber2, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $activeWorksheet->setCellValueExplicit('D' . $tempCount, $ContactNumber3, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $tempCount++;
        }
    }


    $writer = new Xlsx($file);
    $writer->save($fileName);

    header('Cache-Control: public');
    header('Content-Description: File Transfer');
    header('Content-disposition: attachment; filename=' . $fileName);
    header('Content-Type: application/zip');
    header('Content-Transfer-Encoding: binary');

    readfile($fileName);
    unlink($fileName);
    exit;
} elseif (isset($_GET['AdvanceCsv'])) {

    $fileName = 'Contact' . date('dmY') . '.csv';

    $GetContactLog  = $obj->GetContactLog();

    if ($GetContactLog->num_rows == 0) {
        $GetContact  = $obj->GetContactASC();


        if (date('s') == 00) {
            $LessSecond = date('i') - 1;
            $TempTime = date('H:') . $LessSecond . ':59';
        } else {
            $LessSecond = date('s') - 1;
            $TempTime = date('H:') . date('i:') . $LessSecond;
        }

        $objInsert = new Add();
        $objInsert->FileName = $fileName;
        $objInsert->FileType = 'CSV';
        $objInsert->LogToDate = date('Y-m-d');
        $objInsert->LogToTime = $TempTime;
        $objInsert->LogCurrentDate = date('Y-m-d');
        $objInsert->LogCurrentTime = date('H:i:s');
        $AddContactLogNull  = $objInsert->AddContactLogNull();

        if ($AddContactLogNull != true) {
            header('Location:../500.php');
        }
    } else {
        foreach ($GetContactLog as $row) {
            $LogFromDate = $row['LogCurrentDate'];
            $LogFromTime = $row['LogCurrentTime'];
            break;
        }

        $obj->FromData = $LogFromDate;
        $obj->FromTime = $LogFromTime;
        $obj->ToData = date('Y-m-d');
        $obj->ToTime = date('H:i:s');
        $GetContact  = $obj->GetContactByDate();


        if (date('s') == 00) {
            $LessSecond = date('i') - 1;
            $TempTime = date('H:') . $LessSecond . ':59';
        } else {
            $LessSecond = date('s') - 1;
            $TempTime = date('H:') . date('i:') . $LessSecond;
        }

        $objInsert = new Add();
        $objInsert->FileName = $fileName;
        $objInsert->FileType = 'CSV';
        $objInsert->LogFromDate = $LogFromDate;
        $objInsert->LogFromTime = $LogFromTime;
        $objInsert->LogToDate = date('Y-m-d');
        $objInsert->LogToTime = $TempTime;
        $objInsert->LogCurrentDate = date('Y-m-d');
        $objInsert->LogCurrentTime = date('H:i:s');
        $AddContactLog  = $objInsert->AddContactLog();

        if ($AddContactLog != true) {
            header('Location:../500.php');
        }
    }



    $activeWorksheet = $file->getActiveSheet();
    $activeWorksheet->setCellValue('A1', 'Name');
    $activeWorksheet->setCellValue('B1', 'Given Name');
    $activeWorksheet->setCellValue('C1', 'Group Membership');
    $activeWorksheet->setCellValue('D1', 'Phone 1 - Value');
    $activeWorksheet->setCellValue('E1', 'Phone 2 - Value');
    $activeWorksheet->setCellValue('F1', 'Phone 3 - Value');

    $tempCount = 2;
    if ($GetContact->num_rows > 0) {
        foreach ($GetContact as $row) {

            if ($row['ContactNumber1'] == 0) {
                $ContactNumber1 = "";
            } else {
                $ContactNumber1 = $row['ContactNumber1'];
            }
            if ($row['ContactNumber2'] == 0) {
                $ContactNumber2 = "";
            } else {
                $ContactNumber2 = $row['ContactNumber2'];
            }
            if ($row['ContactNumber3'] == 0) {
                $ContactNumber3 = "";
            } else {
                $ContactNumber3 = $row['ContactNumber3'];
            }

            $activeWorksheet->setCellValue('A' . $tempCount, $row['ContactName']);
            $activeWorksheet->setCellValue('B' . $tempCount, $row['ContactName']);
            $activeWorksheet->setCellValue('C' . $tempCount, '* myContacts');
            $activeWorksheet->setCellValueExplicit('D' . $tempCount, $ContactNumber1, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $activeWorksheet->setCellValueExplicit('E' . $tempCount, $ContactNumber2, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $activeWorksheet->setCellValueExplicit('F' . $tempCount, $ContactNumber3, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $tempCount++;
        }
    }


    $writer = new Csv($file);
    $writer->save($fileName);

    header('Cache-Control: public');
    header('Content-Description: File Transfer');
    header('Content-disposition: attachment; filename=' . $fileName);
    header('Content-Type: application/zip');
    header('Content-Transfer-Encoding: binary');

    readfile($fileName);
    unlink($fileName);
    exit;
} elseif (isset($_GET['AdvanceExcel'])) {

    $fileName = 'Contact' . date('dmY') . '.xlsx';

    $GetContactLog  = $obj->GetContactLog();
    if ($GetContactLog->num_rows > 0) {
        foreach ($GetContactLog as $row) {
            if ($row['LogFromDate'] != Null) {
                $LogFromDate = $row['LogFromDate'];
                $LogFromTime = $row['LogFromTime'];
                $LogToDate = $row['LogCurrentDate'];
                $LogToTime = $row['LogCurrentTime'];
                break;
            } elseif ($row['LogFromDate'] == Null) {
                $AllDataCheck = true;
                break;
            }
        }
        if (isset($LogFromDate) == true) {
            $obj->FromData = $LogFromDate;
            $obj->FromTime = $LogFromTime;
            $obj->ToData = $LogToDate;
            $obj->ToTime = $LogToTime;
            $GetContact  = $obj->GetContactByDate();
        }
    } else {
        $GetContact  = $obj->GetContactASC();
    }


    if (isset($AllDataCheck) == True) {
        $GetContact  = $obj->GetContactASC();
    }


    $activeWorksheet = $file->getActiveSheet();
    $activeWorksheet->setCellValue('A1', 'Name');
    $activeWorksheet->setCellValue('B1', 'Given Name');
    $activeWorksheet->setCellValue('C1', 'Group Membership');
    $activeWorksheet->setCellValue('D1', 'Phone 1 - Value');
    $activeWorksheet->setCellValue('E1', 'Phone 2 - Value');
    $activeWorksheet->setCellValue('F1', 'Phone 3 - Value');

    $tempCount = 2;
    if ($GetContact->num_rows > 0) {
        foreach ($GetContact as $row) {
            if ($row['ContactNumber1'] == 0) {
                $ContactNumber1 = "";
            } else {
                $ContactNumber1 = $row['ContactNumber1'];
            }
            if ($row['ContactNumber2'] == 0) {
                $ContactNumber2 = "";
            } else {
                $ContactNumber2 = $row['ContactNumber2'];
            }
            if ($row['ContactNumber3'] == 0) {
                $ContactNumber3 = "";
            } else {
                $ContactNumber3 = $row['ContactNumber3'];
            }

            $activeWorksheet->setCellValue('A' . $tempCount, $row['ContactName']);
            $activeWorksheet->setCellValue('B' . $tempCount, $row['ContactName']);
            $activeWorksheet->setCellValue('C' . $tempCount, '* myContacts');
            $activeWorksheet->setCellValueExplicit('D' . $tempCount, $ContactNumber1, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $activeWorksheet->setCellValueExplicit('E' . $tempCount, $ContactNumber2, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $activeWorksheet->setCellValueExplicit('F' . $tempCount, $ContactNumber3, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $tempCount++;
        }
    }



    $writer = new Xlsx($file);
    $writer->save($fileName);

    header('Cache-Control: public');
    header('Content-Description: File Transfer');
    header('Content-disposition: attachment; filename=' . $fileName);
    header('Content-Type: application/zip');
    header('Content-Transfer-Encoding: binary');

    readfile($fileName);
    unlink($fileName);
    exit;
} elseif (isset($_GET['AllInCsv'])==true) {

    $fileName = 'AllGoogleContact' . date('dmY') . '.csv';

    $GetContact  = $obj->GetContactASC();

    $activeWorksheet = $file->getActiveSheet();
    $activeWorksheet->setCellValue('A1', 'Name');
    $activeWorksheet->setCellValue('B1', 'Given Name');
    $activeWorksheet->setCellValue('C1', 'Group Membership');
    $activeWorksheet->setCellValue('D1', 'Phone 1 - Value');
    $activeWorksheet->setCellValue('E1', 'Phone 2 - Value');
    $activeWorksheet->setCellValue('F1', 'Phone 3 - Value');

    $tempCount = 2;
    if ($GetContact->num_rows > 0) {
        foreach ($GetContact as $row) {
            if ($row['ContactNumber1'] == 0) {
                $ContactNumber1 = "";
            } else {
                $ContactNumber1 = $row['ContactNumber1'];
            }
            if ($row['ContactNumber2'] == 0) {
                $ContactNumber2 = "";
            } else {
                $ContactNumber2 = $row['ContactNumber2'];
            }
            if ($row['ContactNumber3'] == 0) {
                $ContactNumber3 = "";
            } else {
                $ContactNumber3 = $row['ContactNumber3'];
            }

            $activeWorksheet->setCellValue('A' . $tempCount, $row['ContactName']);
            $activeWorksheet->setCellValue('B' . $tempCount, $row['ContactName']);
            $activeWorksheet->setCellValue('C' . $tempCount, '* myContacts');
            $activeWorksheet->setCellValueExplicit('D' . $tempCount, $ContactNumber1, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $activeWorksheet->setCellValueExplicit('E' . $tempCount, $ContactNumber2, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $activeWorksheet->setCellValueExplicit('F' . $tempCount, $ContactNumber3, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $tempCount++;
        }
    }
    $writer = new Csv($file);
    $writer->save($fileName);

    header('Cache-Control: public');
    header('Content-Description: File Transfer');
    header('Content-disposition: attachment; filename=' . $fileName);
    header('Content-Type: application/zip');
    header('Content-Transfer-Encoding: binary');

    readfile($fileName);
    unlink($fileName);
    exit;


}