<?php
session_start();
include("inc/AdminHeader.php");
require_once("BackEnd/ClsSelect.php");

$obj = new Get();
$GetContactLog  = $obj->GetContactLog();
?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Export List</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-6">

                    <div class="card">
                        <div class="card-header">
                            <h4>Basic CSV/Excel</h4>
                        </div>
                        <div class="card-body">
                            In here till will Generate Excel which will contain all the contacts available in data base.
                            Note that this file is just for sharing you can not import it to google contact.
                        </div>
                        <div class="card-footer text-right">
                            <!-- <a href="BackEnd/DownLoad.php?BasicCsv"><button class="btn btn-primary">Export CSV</button></a>&nbsp;&nbsp; -->
                            <a href="BackEnd/DownLoad.php?BasicExcel"><button class="btn btn-primary">Export Excel</button></a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Advance CSV/Excel</h4>
                        </div>
                        <div class="card-body">
                            In here it will Generate CSV/Excel that contain the data from last time you exported till today.
                            Only CSV file is compatiable with the Google Contacts so that you can import it into Google Contacts.
                        </div>
                        <div class="card-footer text-right">

                            <a href="BackEnd/DownLoad.php?AdvanceCsv"><button class="btn btn-primary">Export CSV</button></a>&nbsp;&nbsp;
                            <a href="BackEnd/DownLoad.php?AdvanceExcel"><button class="btn btn-primary">Export Excel</button></a>&nbsp;&nbsp;
                            <a href="BackEnd/DownLoad.php?AllInCsv"><button class="btn btn-primary"><i class="fas fa-arrow-down"></i></button></a>
                        </div>
                    </div>

                </div>
            </div>

            <?php
            if ($GetContactLog->num_rows == 0) {
            }
            ?>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Downloaded Contact Log</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-2">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="custom-checkbox custom-control">
                                                    <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                                                    <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                                </div>
                                            </th>
                                            <th>File Name</th>
                                            <th>File Type</th>
                                            <th>Staring Date & Time</th>
                                            <th>Downloaded Date & Time</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $temp = 1;
                                        if ($GetContactLog->num_rows > 0) :
                                            foreach ($GetContactLog as $row) :
                                        ?>
                                                <tr style="margin-top: 50px;">
                                                    <td>
                                                        <div class="custom-checkbox custom-control">
                                                            <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-<?php echo $temp; ?>">
                                                            <label for="checkbox-<?php echo $temp; ?>" class="custom-control-label">&nbsp;</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['FileName']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['FileType']; ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($row['LogFromDate'] != Null) {
                                                            $tempDate = explode('-', $row['LogFromDate']);
                                                            echo $tempDate[2] . '-' . $tempDate[1] . '-' . $tempDate[0];

                                                            $tempTime = explode(':', $row['LogFromTime']);
                                                            if ($tempTime[0] >= 12) {
                                                                if ($tempTime[0] == 12) {
                                                                    echo $row['LogFromTime'] . ' PM';
                                                                } else {
                                                                    echo 0 . ($tempTime[0] - 12) . ':' . $tempTime[1] . ':' . $tempTime[2] . ' PM';
                                                                }
                                                            } else {
                                                                if ($tempTime[0] == 0) {
                                                                    echo ($tempTime[0] + 12) . ':' . $tempTime[1] . ':' . $tempTime[2] . ' AM';
                                                                } else {
                                                                    echo $row['LogFromTime'] . ' AM';
                                                                }
                                                            }
                                                        }
                                                        else{
                                                            echo 'Null';
                                                        }

                                                        ?>
                                                    </td>

                                                    <td>
                                                        <?php
                                                        if ($row['LogToDate'] != Null) {
                                                            $tempDate = explode('-', $row['LogToDate']);
                                                            echo $tempDate[2] . '-' . $tempDate[1] . '-' . $tempDate[0].'&nbsp;&nbsp;&nbsp;';

                                                            $tempTime = explode(':', $row['LogToTime']);
                                                            if ($tempTime[0] >= 12) {
                                                                if ($tempTime[0] == 12) {
                                                                    echo $row['LogToTime'] . ' PM';
                                                                } else {
                                                                    echo 0 . ($tempTime[0] - 12) . ':' . $tempTime[1] . ':' . $tempTime[2] . ' PM';
                                                                }
                                                            } else {
                                                                if ($tempTime[0] == 0) {
                                                                    echo ($tempTime[0] + 12) . ':' . $tempTime[1] . ':' . $tempTime[2] . ' AM';
                                                                } else {
                                                                    echo $row['LogToTime'] . ' AM';
                                                                }
                                                            }
                                                        }

                                                        ?>
                                                    </td>

                                                    <td>
                                                        <a href="BackEnd/SpecificDownload.php?TokenType=csv&TokenId=<?php echo $row['LogID']; ?>" class="btn btn-primary"><i class="fas fa-arrow-down"></i>&nbsp;CSV</a>&nbsp;&nbsp;
                                                        <a href="BackEnd/SpecificDownload.php?TokenType=xlsx&TokenId=<?php echo $row['LogID']; ?>" class="btn btn-primary"><i class="fas fa-arrow-down"></i>&nbsp;Excel</a>&nbsp;&nbsp;
                                                        <a href="BackEnd/DbDelete.php?TokenType=log&TokenId=<?php echo $row['LogID']; ?>" class="btn btn-icon btn-danger" onclick="return Surety()"><i class="fas fa-times"></i></a>
                                                    </td>
                                                </tr>
                                        <?php
                                                $temp++;
                                            endforeach;
                                        endif;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

           


        </div>

    </section>
</div>
<?php include("inc/AdminFooter.php"); ?>