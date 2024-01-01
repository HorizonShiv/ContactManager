<?php
session_start();
include("inc/AdminHeader.php");
require_once("BackEnd/ClsSelect.php");

?>

<?php

$obj = new Get();
$GetContact  = $obj->GetContact();

?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>User Contact List</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Basic DataTables</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>Contact Name</th>
                                            <th>Contact Number 1</th>
                                            <th>Contact Number 2</th>
                                            <th>Contact Number 3</th>
                                            <th>Contact Number 3</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $temp = 1;
                                        if ($GetContact->num_rows > 0) :
                                            foreach ($GetContact as $row) :
                                        ?>
                                                <tr style="margin-top: 50px;">

                                                    <td>
                                                        <?php echo $row['ContactName']; ?>
                                                    </td>
                                                    <td>
                                                    <?php echo '<a class="ContactLink" href="tel:+'.$row['ContactNumber1'].'">'.$row['ContactNumber1'].'</a>'; ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($row['ContactNumber2'] == 0) {
                                                            echo 'Null';
                                                        } else {
                                                            echo '<a class="ContactLink" href="tel:+'.$row['ContactNumber2'].'">'.$row['ContactNumber2'].'</a>';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($row['ContactNumber3'] == 0) {
                                                            echo 'Null';
                                                        } else {
                                                            echo '<a class="ContactLink" href="tel:+'.$row['ContactNumber3'].'">'.$row['ContactNumber3'].'</a>';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $tempDate = explode('-', $row['Date']);
                                                        echo $tempDate[2] . '-' . $tempDate[1] . '-' . $tempDate[0];
                                                        ?>
                                                    </td>
                                                    <td>

                                                        <a href="ModifyContact.php?TokenId=<?php echo $row['ContactID']; ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a>&nbsp;&nbsp; 
                                                        <a href="BackEnd/DbDelete.php?TokenType=contact&TokenId=<?php echo $row['ContactID']; ?>" class="btn btn-icon btn-danger" onclick="return Surety()"><i class="fas fa-times"></i></a>

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
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Cantact Number</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <div class="col-sm-12 col-md-12">
                                    <textarea class="codeeditor"><?php
                                                                    if ($GetContact->num_rows > 0) {
                                                                        foreach ($GetContact as $row) {
                                                                            echo $row['ContactNumber1'] . "\n";
                                                                            if($row['ContactNumber2']!=0){
                                                                                echo $row['ContactNumber2'] . "\n";
                                                                            }
                                                                            if($row['ContactNumber3']!=0){
                                                                                echo $row['ContactNumber3'] . "\n";
                                                                            }
                                                                        }
                                                                    } ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </section>
</div>

<?php include("inc/AdminFooter.php"); ?>