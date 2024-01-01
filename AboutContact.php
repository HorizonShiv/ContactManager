<?php
session_start();
require_once("BackEnd/ClsInsert.php");
require_once("BackEnd/ClsSelect.php");


if (isset($_POST['Contact']) == true) :
    include("inc/AdminHeader.php");

    for ($i = 0; $i < count($_POST['Number']); $i++) {
        if ($_POST['Number'][$i] === "" || $_POST['Number'][$i] === null) {
            $TempLength = $i; // Update the length when a blank value is encountered
            break; // Exit the loop
        }
    }

    $ExistNo = [];
    $NotExistNo = [];
    $ExistName = [];
    $ExistID = [];

    $FoundInField = [];

    if (isset($TempLength) == true) {
        for ($i = 0; $i < $TempLength; $i++) {
            $Number = $_POST['Code'][$i] . $_POST['Number'][$i];

            $obj = new Get();
            $obj->Number = $Number;
            $CheckNumber = $obj->CheckNumber();

            if ($CheckNumber == true) {
                if ($CheckNumber->num_rows > 0) {
                    foreach ($CheckNumber as $row) {
                        array_push($ExistNo, $_POST['Code'][$i] . $_POST['Number'][$i]);
                        array_push($ExistName, $row['ContactName']);
                        array_push($ExistID, $row['ContactID']);
                    }
                }
            } else {
                array_push($NotExistNo, $_POST['Code'][$i] . $_POST['Number'][$i]);
            }
        }
    } else {
        for ($i = 0; $i < count($_POST['Number']); $i++) {

            $Number = $_POST['Code'][$i] . $_POST['Number'][$i];

            $obj = new Get();
            $obj->Number = $Number;
            $CheckNumber = $obj->CheckNumber();

            if ($CheckNumber == true) {
                if ($CheckNumber->num_rows > 0) {
                    foreach ($CheckNumber as $row) {
                        array_push($ExistNo, $_POST['Code'][$i] . $_POST['Number'][$i]);
                        array_push($ExistName, $row['ContactName']);
                        array_push($ExistID, $row['ContactID']);
                    }
                }
            } else {
                array_push($NotExistNo, $_POST['Code'][$i] . $_POST['Number'][$i]);
            }
        }
    }

    $_SESSION['ExistNo'] = $ExistNo;
    $_SESSION['ExistName'] = $ExistName;
    $_SESSION['ExistID'] = $ExistID;
    $_SESSION['NotExistNo'] = $NotExistNo;



    if (count($ExistName) == 2) {
        if ($ExistName[0] != $ExistName[1]) {
            $doubleEntry = true;
        }
    }
    if (!empty($ExistNo)) {
        echo "<script>alert('Entry Exist in database...!! Might have the different User name');</script>";
    }


    if (empty($NotExistNo)) {
        // header('Location:index.php');
        echo "<script>window.location.href = 'index.php'</script>";
    }

    if (empty($ExistNo)) {

        date_default_timezone_set("Asia/Calcutta");
        $UserTime = date('H:i:s');
        $UserDate = date('Y-m-d');


        if ($NotExistNo[0] == "") {
            $ContactNumber1 = 0;
        } else {
            $ContactNumber1 = $NotExistNo[0];
        }

        if ($NotExistNo[1] == "") {
            $ContactNumber2 = 0;
        } else {
            $ContactNumber2 = $NotExistNo[1];
        }

        if ($NotExistNo[2] == "") {
            $ContactNumber3 = 0;
        } else {
            $ContactNumber3 = $NotExistNo[2];
        }

        $objInsert = new Add();
        $objInsert->ContactName = $_POST['UserName'];
        $objInsert->ContactNumber1 = $ContactNumber1;
        $objInsert->ContactNumber2 = $ContactNumber2;
        $objInsert->ContactNumber3 = $ContactNumber3;
        $objInsert->Date = $UserDate;
        $objInsert->Time = $UserTime;
        $AddUserContact = $objInsert->AddUserContact();

        if ($AddUserContact == true) {
            $_SESSION['Done'] = True;
            echo "<script>window.location.href = 'index.php'</script>";
        } else {
            echo "<script>window.location.href = '500.php'</script>";
        }
    }


?>

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Updation Form</h1>
            </div>
            <div class="section-body">
                <h2 class="section-title">Checking Form</h2>
                <p class="section-lead">Here you have the old data that match with some of the value you have entered</p><br>
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-12 col-md-8 col-lg-8">
                        <div class="card card-primary">
                            <div class="card-body">

                                <form action="BackEnd/DbPreform.php" method="post" enctype="multipart/form-data">
                                    <?php for ($j = 0; $j < count($ExistNo); $j++) : ?>
                                        <div class="alert alert-light alert-dismissible show fade">
                                            <div class="alert-body">
                                                <button class="close" data-dismiss="alert">
                                                    <span>&times;</span>
                                                </button>
                                                <strong><?php echo $ExistNo[$j]; ?></strong> is already in database Named By <strong>'<?php echo $ExistName[$j]; ?>'</strong>
                                            </div>
                                        </div>
                                    <?php endfor; ?>
                                    <br>

                                    <?php if (isset($doubleEntry) == true) : ?>
                                        <div class="section-title mt-0">Choose Name</div>
                                        <div class="form-group">
                                            <label>Choose The Service</label>
                                            <select class="custom-select" name="ChosenName" required>
                                                <?php for ($j = 0; $j < count($ExistName); $j++) : ?>
                                                    <option value="<?php echo $ExistName[$j] . '&' . $ExistID[$j]; ?>"><?php echo $ExistName[$j]; ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                    <?php endif; ?>


                                    <div class="section-title">Action to be performed</div>
                                    <p>
                                        If you want to Update data in older name then press the <strong><code>Update Button</code></strong> otherwise to create whole new contact click on <strong> <code>Create a New Contact</code></strong> Button
                                        <br>
                                        If you press the create new contact then the name will be set to the one you have entered it the previous form.
                                        <br>
                                        If you press the Update button then the name will be set to the one you have chose in upper dowpdown.
                                    </p>
                                    <div class="form-group">
                                        <label>Name you have entered in pervious form</label>
                                        <input type="text" class="form-control" value="<?php echo $_POST['UserName'] ?>" name="UserName">
                                    </div>

                                    <hr><br>

                                    <div class="form-group ContactBtn">
                                        <input type="submit" class="btn btn-primary" name="CreateNewContact" value="Create New Contact">
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="submit" class="btn btn-primary" name="UpdateOldContact" value="Update">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

<?php
    include("inc/AdminFooter.php");
endif;
?>