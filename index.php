<?php
session_start();
require_once("BackEnd/ClsSelect.php");

if (isset($_SESSION['LoginErr']) == true) {
  echo "<script>alert('User Id or Password is Wrong..!!');</script>";
  unset($_SESSION['LoginErr']);
}


if (isset($_SESSION['Max']) == true) {
  echo "<script>alert('Maximun Number...!! You can add upto 3 number per user only...!! You have to add that unique number again.');</script>";
  unset($_SESSION['Max']);
}


if (isset($_SESSION['Login']) != true) :
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport" />
    <title>Login &mdash; SmartNestFM</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="dist/assets/modules/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="dist/assets/modules/fontawesome/css/all.min.css" />

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="dist/assets/modules/bootstrap-social/bootstrap-social.css" />

    <!-- Template CSS -->
    <link rel="stylesheet" href="dist/assets/css/style.css" />
    <link rel="stylesheet" href="dist/assets/css/components.css" />

    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>

    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() {
        dataLayer.push(arguments);
      }
      gtag("js", new Date());

      gtag("config", "UA-94034622-3");
    </script>
    <!-- /END GA -->
  </head>

  <body>
    <div id="app">
      <section class="section">
        <div class="container mt-5">
          <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
              <div class="login-brand">
                <!-- images -->
              </div>

              <div class="card card-primary">
                <div class="card-header">
                  <h4>Login</h4>
                </div>

                <div class="card-body">
                  <form method="POST" action="BackEnd/DbSelect.php" class="needs-validation" novalidate="">
                    <div class="form-group">
                      <label for="UserId">Email</label>
                      <input id="UserId" type="UserId" class="form-control" name="UserId" tabindex="1" required autofocus />
                      <div class="invalid-feedback">
                        Please fill in your UserId
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="d-block">
                        <label for="password" class="control-label">Password</label>
                        <div class="float-right">
                          <a href="auth-forgot-password.html" class="text-small">
                            Forgot Password?
                          </a>
                        </div>
                      </div>
                      <input id="password" type="password" class="form-control" name="Password" tabindex="2" required />
                      <div class="invalid-feedback">
                        please fill in your password
                      </div>
                    </div>

                    <div class="form-group">
                      <input type="submit" name="Login" class="btn btn-primary btn-lg btn-block" tabindex="4" value="Login">
                    </div>
                  </form>
                </div>
              </div>
              <div class="mt-5 text-muted text-center">
                Our Privacy Policy | 
                <a href="PrivacyPolicy.php">View Policy</a>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <!-- General JS Scripts -->
    <script src="dist/assets/modules/jquery.min.js"></script>
    <script src="dist/assets/modules/popper.js"></script>
    <script src="dist/assets/modules/tooltip.js"></script>
    <script src="dist/assets/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="dist/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="dist/assets/modules/moment.min.js"></script>
    <script src="dist/assets/js/stisla.js"></script>

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="dist/assets/js/scripts.js"></script>
    <script src="dist/assets/js/custom.js"></script>
  </body>

  </html>
<?php endif; ?>


<?php

if (isset($_SESSION['Login']) == true) :
  $objGet = new Get();
  $GetContactCount  = $objGet->GetContactCount();
  $rowCount = $GetContactCount->fetch_assoc();
?>


  <?php include("inc/AdminHeader.php"); ?>

  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Dashboard/Form Page</h1>
      </div>

      <div class="section-body">

        
        <h2 class="section-title">Entry Form <div class="Count"><?php echo 'Total Contact : '.$rowCount['ContactCount']; ?></div></h2>
        <p class="section-lead">New data has to be fill over here</p><br>
        
        

        <div class="row">
          <div class="col-2"></div>
          <div class="col-12 col-md-8 col-lg-8">
            <div class="card card-primary">
              <div class="card-body">
                <form action="AboutContact.php" method="post" enctype="multipart/form-data">

                  <div class="section-title">User Name</div>
                  <div class="form-group">
                    <!-- <label>Choose One</label> -->
                    <input type="text" class="form-control" name="UserName">
                  </div>
  
                  <div class="section-title">Country &amp; Phone Number</div>
                  <div class="form-group">
                    <div class="input-group">
                      <select class="custom-select select2" id="inputGroupSelect05" name="Code[]">
                        <option value="+1">United States - +1</option>
                        <option value="+1">Canada - +1</option>
                        <option value="+44">United Kingdom - +44</option>
                        <option value="+61">Australia - +61</option>
                        <option value="+91" selected>India - +91</option>
                        <option value="+49">Germany - +49</option>
                        <option value="+33">France - +33</option>
                        <option value="+86">China - +86</option>
                        <option value="+81">Japan - +81</option>
                        <option value="+55">Brazil - +55</option>
                        <option value="+7">Russia - +7</option>
                        <option value="+27">South Africa - +27</option>
                        <option value="+52">Mexico - +52</option>
                        <option value="+966">Saudi Arabia - +966</option>
                        <option value="+82">South Korea - +82</option>
                      </select>
                      <input type="text" class="form-control" name="Number[]">
                    </div>
                  </div>

                  <div class="section-title">Country &amp; Phone Number</div>
                  <div class="form-group">
                    <div class="input-group">
                      <select class="custom-select select2" id="inputGroupSelect05" name="Code[]">
                        <option value="+1">United States - +1</option>
                        <option value="+1">Canada - +1</option>
                        <option value="+44">United Kingdom - +44</option>
                        <option value="+61">Australia - +61</option>
                        <option value="+91" selected>India - +91</option>
                        <option value="+49">Germany - +49</option>
                        <option value="+33">France - +33</option>
                        <option value="+86">China - +86</option>
                        <option value="+81">Japan - +81</option>
                        <option value="+55">Brazil - +55</option>
                        <option value="+7">Russia - +7</option>
                        <option value="+27">South Africa - +27</option>
                        <option value="+52">Mexico - +52</option>
                        <option value="+966">Saudi Arabia - +966</option>
                        <option value="+82">South Korea - +82</option>
                      </select>
                      <input type="text" class="form-control" name="Number[]">
                    </div>
                  </div>

                  <div class="section-title">Country &amp; Phone Number</div>
                  <div class="form-group">
                    <div class="input-group">
                      <select class="custom-select select2" id="inputGroupSelect05" name="Code[]">
                        <option value="+1">United States - +1</option>
                        <option value="+1">Canada - +1</option>
                        <option value="+44">United Kingdom - +44</option>
                        <option value="+61">Australia - +61</option>
                        <option value="+91" selected>India - +91</option>
                        <option value="+49">Germany - +49</option>
                        <option value="+33">France - +33</option>
                        <option value="+86">China - +86</option>
                        <option value="+81">Japan - +81</option>
                        <option value="+55">Brazil - +55</option>
                        <option value="+7">Russia - +7</option>
                        <option value="+27">South Africa - +27</option>
                        <option value="+52">Mexico - +52</option>
                        <option value="+966">Saudi Arabia - +966</option>
                        <option value="+82">South Korea - +82</option>
                      </select>
                      <input type="text" class="form-control" name="Number[]">
                    </div>
                  </div>

                  <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="Contact" value="Submit">&nbsp;&nbsp;&nbsp;&nbsp;
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
  <?php
  // if (isset($_SESSION['Done']) == true) {
  //   echo "<script>alert('Completed..!!');</script>";
  //   unset($_SESSION['Done']);
  //   unset($_SESSION['ExistNo']);
  //   unset($_SESSION['ExistName']);
  //   unset($_SESSION['ExistID']);
  //   unset($_SESSION['NotExistNo']);

  // }
  ?>

<?php endif; ?>