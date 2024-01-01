<?php
session_start();
require_once("BackEnd/ClsSelect.php");
include("inc/AdminHeader.php"); ?>

<?php
$objGet = new Get();
$GetContactCount  = $objGet->GetContactCount();
$rowCount = $GetContactCount->fetch_assoc();

$objGet->ContactID = $_GET['TokenId'];
$GetContactById = $objGet->GetContactById();
$rowData = $GetContactById->fetch_assoc();
?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Contact</h1>
        </div>

        <div class="section-body">


            <h2 class="section-title">Modification Form<div class="Count"><a class="btn btn-outline-primary" href="Contact.php">Go Back</a></div></h2>
            <p class="section-lead">Modify your data over here</p><br>
            <?php

            $_SESSION['ContactID']= $_GET['TokenId'];

            $phoneNumber1 = $rowData['ContactNumber1']; // The string to check
            $phoneNumber2 = $rowData['ContactNumber2']; // The string to check
            $phoneNumber3 = $rowData['ContactNumber3']; // The string to check
            $countryCodes = ["+1", "+44", "+61", "+91", "+49", "+33", "+86", "+81", "+55", "+7", "+27", "+52", "+966", "+82"]; // Array of country codes

            $matchingCode1 = null;
            $matchingCode2 = null;
            $matchingCode3 = null;

            foreach ($countryCodes as $code) {
                if (strpos($phoneNumber1, $code) === 0) {
                    $matchingCode1 = $code;
                    break; // Exit the loop as soon as a match is found
                }
            }

            foreach ($countryCodes as $code) {
                if (strpos($phoneNumber2, $code) === 0) {
                    $matchingCode2 = $code;
                    break; // Exit the loop as soon as a match is found
                }
            }

            foreach ($countryCodes as $code) {
                if (strpos($phoneNumber3, $code) === 0) {
                    $matchingCode3 = $code;
                    break; // Exit the loop as soon as a match is found
                }
            }

            ?>



            <div class="row">
                <div class="col-2"></div>
                <div class="col-12 col-md-8 col-lg-8">
                    <div class="card card-primary">
                        <div class="card-body">
                            <form action="BackEnd/DbUpdate.php" method="post" enctype="multipart/form-data">

                                <div class="section-title">User Name</div>
                                <?php if ($matchingCode1 == "+1") {
                                    echo "selected";
                                } ?>
                                <div class="form-group">
                                    <!-- <label>Choose One</label> -->
                                    <input type="text" class="form-control" value="<?php echo $rowData['ContactName']; ?>" name="UserName">
                                </div>

                                <div class="section-title">Country &amp; Phone Number</div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <select class="custom-select select2" id="inputGroupSelect05" name="Code[]">
                                            <option value="+1" <?php if ($matchingCode1 == "+1") {
                                                                    echo "selected";
                                                                } ?>>United States - +1</option>
                                            <option value="+1">Canada - +1</option>
                                            <option value="+44" <?php if ($matchingCode1 == "+44") {
                                                                    echo "selected";
                                                                } ?>>United Kingdom - +44</option>
                                            <option value="+61" <?php if ($matchingCode1 == "+61") {
                                                                    echo "selected";
                                                                } ?>>Australia - +61</option>
                                            <option value="+91" <?php if ($matchingCode1 == "+91") {
                                                                    echo "selected";
                                                                } ?>>India - +91</option>
                                            <option value="+49" <?php if ($matchingCode1 == "+49") {
                                                                    echo "selected";
                                                                } ?>>Germany - +49</option>
                                            <option value="+33" <?php if ($matchingCode1 == "+33") {
                                                                    echo "selected";
                                                                } ?>>France - +33</option>
                                            <option value="+86" <?php if ($matchingCode1 == "+86") {
                                                                    echo "selected";
                                                                } ?>>China - +86</option>
                                            <option value="+81" <?php if ($matchingCode1 == "+81") {
                                                                    echo "selected";
                                                                } ?>>Japan - +81</option>
                                            <option value="+55" <?php if ($matchingCode1 == "+55") {
                                                                    echo "selected";
                                                                } ?>>Brazil - +55</option>
                                            <option value="+7" <?php if ($matchingCode1 == "+7") {
                                                                    echo "selected";
                                                                } ?>>Russia - +7</option>
                                            <option value="+27" <?php if ($matchingCode1 == "+27") {
                                                                    echo "selected";
                                                                } ?>>South Africa - +27</option>
                                            <option value="+52" <?php if ($matchingCode1 == "+52") {
                                                                    echo "selected";
                                                                } ?>>Mexico - +52</option>
                                            <option value="+966" <?php if ($matchingCode1 == "+966") {
                                                                        echo "selected";
                                                                    } ?>>Saudi Arabia - +966</option>
                                            <option value="+82" <?php if ($matchingCode1 == "+82") {
                                                                    echo "selected";
                                                                } ?>>South Korea - +82</option>
                                        </select>
                                        <input type="text" class="form-control" value="<?php if($matchingCode1!=null){echo str_replace($matchingCode1, "", $phoneNumber1);} ?>" name="Number[]">
                                    </div>
                                </div>

                                <div class="section-title">Country &amp; Phone Number</div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <select class="custom-select select2" id="inputGroupSelect05" name="Code[]">
                                            <option value="+1" <?php if ($matchingCode2 == "+1") {
                                                                    echo "selected";
                                                                } ?>>United States - +1</option>
                                            <option value="+1">Canada - +1</option>
                                            <option value="+44" <?php if ($matchingCode2 == "+44") {
                                                                    echo "selected";
                                                                } ?>>United Kingdom - +44</option>
                                            <option value="+61" <?php if ($matchingCode2 == "+61") {
                                                                    echo "selected";
                                                                } ?>>Australia - +61</option>
                                            <option value="+91" <?php if ($matchingCode2 == "+91") {
                                                                    echo "selected";
                                                                } ?>>India - +91</option>
                                            <option value="+49" <?php if ($matchingCode2 == "+49") {
                                                                    echo "selected";
                                                                } ?>>Germany - +49</option>
                                            <option value="+33" <?php if ($matchingCode2 == "+33") {
                                                                    echo "selected";
                                                                } ?>>France - +33</option>
                                            <option value="+86" <?php if ($matchingCode2 == "+86") {
                                                                    echo "selected";
                                                                } ?>>China - +86</option>
                                            <option value="+81" <?php if ($matchingCode2 == "+81") {
                                                                    echo "selected";
                                                                } ?>>Japan - +81</option>
                                            <option value="+55" <?php if ($matchingCode2 == "+55") {
                                                                    echo "selected";
                                                                } ?>>Brazil - +55</option>
                                            <option value="+7" <?php if ($matchingCode2 == "+7") {
                                                                    echo "selected";
                                                                } ?>>Russia - +7</option>
                                            <option value="+27" <?php if ($matchingCode2 == "+27") {
                                                                    echo "selected";
                                                                } ?>>South Africa - +27</option>
                                            <option value="+52" <?php if ($matchingCode2 == "+52") {
                                                                    echo "selected";
                                                                } ?>>Mexico - +52</option>
                                            <option value="+966" <?php if ($matchingCode2 == "+966") {
                                                                        echo "selected";
                                                                    } ?>>Saudi Arabia - +966</option>
                                            <option value="+82" <?php if ($matchingCode2 == "+82") {
                                                                    echo "selected";
                                                                } ?>>South Korea - +82</option>
                                        </select>
                                        <input type="text" class="form-control" value="<?php if($matchingCode2!=null){ echo str_replace($matchingCode2, "", $phoneNumber2);} ?>" name="Number[]">
                                    </div>
                                </div>

                                <div class="section-title">Country &amp; Phone Number</div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <select class="custom-select select2" id="inputGroupSelect05" name="Code[]">
                                            <option value="+1" <?php if ($matchingCode3 == "+1") {
                                                                    echo "selected";
                                                                } ?>>United States - +1</option>
                                            <option value="+1">Canada - +1</option>
                                            <option value="+44" <?php if ($matchingCode3 == "+44") {
                                                                    echo "selected";
                                                                } ?>>United Kingdom - +44</option>
                                            <option value="+61" <?php if ($matchingCode3 == "+61") {
                                                                    echo "selected";
                                                                } ?>>Australia - +61</option>
                                            <option value="+91" <?php if ($matchingCode3 == "+91") {
                                                                    echo "selected";
                                                                } ?>>India - +91</option>
                                            <option value="+49" <?php if ($matchingCode3 == "+49") {
                                                                    echo "selected";
                                                                } ?>>Germany - +49</option>
                                            <option value="+33" <?php if ($matchingCode3 == "+33") {
                                                                    echo "selected";
                                                                } ?>>France - +33</option>
                                            <option value="+86" <?php if ($matchingCode3 == "+86") {
                                                                    echo "selected";
                                                                } ?>>China - +86</option>
                                            <option value="+81" <?php if ($matchingCode3 == "+81") {
                                                                    echo "selected";
                                                                } ?>>Japan - +81</option>
                                            <option value="+55" <?php if ($matchingCode3 == "+55") {
                                                                    echo "selected";
                                                                } ?>>Brazil - +55</option>
                                            <option value="+7" <?php if ($matchingCode3 == "+7") {
                                                                    echo "selected";
                                                                } ?>>Russia - +7</option>
                                            <option value="+27" <?php if ($matchingCode3 == "+27") {
                                                                    echo "selected";
                                                                } ?>>South Africa - +27</option>
                                            <option value="+52" <?php if ($matchingCode3 == "+52") {
                                                                    echo "selected";
                                                                } ?>>Mexico - +52</option>
                                            <option value="+966" <?php if ($matchingCode3 == "+966") {
                                                                        echo "selected";
                                                                    } ?>>Saudi Arabia - +966</option>
                                            <option value="+82" <?php if ($matchingCode3 == "+82") {
                                                                    echo "selected";
                                                                } ?>>South Korea - +82</option>
                                        </select>
                                        <input type="text" class="form-control" value="<?php if($matchingCode3!=null){echo str_replace($matchingCode3, "", $phoneNumber3);} ?>" name="Number[]">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" name="ContactModify" value="Submit">&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="reset" class="btn btn-secondary" value="Clear">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>
</div>

<?php include("inc/AdminFooter.php"); ?>