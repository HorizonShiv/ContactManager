<?php
$currentURL = $_SERVER['REQUEST_URI'];
$tempURL = explode('/', $currentURL);

if (end($tempURL) == '' || end($tempURL) == "index.php") {
  $Dashboard = true;
} elseif (end($tempURL) == "AboutContact.php") {
  $AboutContact = true;
} elseif (end($tempURL) == "Contact.php") {
  $Contact = true;
} elseif (end($tempURL) == "Export.php") {
  $Export = true;
}

$urlString = "ModifyContact.php";
if (strpos(end($tempURL), $urlString) === 0) {
  $Contact = true;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Nirav Shah</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="dist/assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="dist/assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="dist/assets/modules/jqvmap/dist/jqvmap.min.css">
  <link rel="stylesheet" href="dist/assets/modules/weather-icon/css/weather-icons.min.css">
  <link rel="stylesheet" href="dist/assets/modules/weather-icon/css/weather-icons-wind.min.css">
  <link rel="stylesheet" href="dist/assets/modules/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="dist/assets/modules/ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/assets/modules/datatables/datatables.min.css">
  <link rel="stylesheet" href="dist/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="dist/assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">
  <link rel="stylesheet" href="dist/assets/modules/dropzonejs/dropzone.css">
  <link rel="stylesheet" href="dist/assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="dist/assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css">
  <link rel="stylesheet" href="dist/assets/modules/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="dist/assets/modules/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <link rel="stylesheet" href="dist/assets/modules/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="dist/assets/modules/jquery-selectric/selectric.css">
  <link rel="stylesheet" href="dist/assets/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
  <link rel="stylesheet" href="dist/assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
  <link rel="stylesheet" href="dist/assets/modules/weather-icon/css/weather-icons.min.css">
  <link rel="stylesheet" href="dist/assets/modules/weather-icon/css/weather-icons-wind.min.css">
  <link rel="stylesheet" href="dist/assets/modules/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="dist/assets/modules/codemirror/lib/codemirror.css">
  <link rel="stylesheet" href="dist/assets/modules/codemirror/theme/duotone-dark.css">
  <link rel="stylesheet" href="dist/assets/modules/jquery-selectric/selectric.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="dist/assets/css/style.css">
  <link rel="stylesheet" href="dist/assets/css/components.css">

  <!-- Start GA -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-94034622-3');
  </script>
  <!-- /END GA -->

  <style>
    .Count {
      display: inline-flex;
      float: right;
      overflow: hidden;
    }
    .ContactLink{
        /*color:black;*/
        color:rgb(108, 117, 125);
    }
    .ContactLink:hover{
        /*color:rgb(108, 117, 125);*/
        color:black;
        text-decoration: none;
    }
  </style>

</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          </ul>
          <div class="search-element">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
            <div class="search-backdrop"></div>
            <div class="search-result">
              <div class="search-header">
                Histories
              </div>
              <div class="search-item">
                <a href="#">How to hack NASA using CSS</a>
                <a href="#" class="search-close"><i class="fas fa-times"></i></a>
              </div>
            </div>
          </div>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <img alt="image" src="dist/assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
              <div class="d-sm-none d-lg-inline-block">Hi, <?php echo $_SESSION['UserName']; ?></div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <!-- <div class="dropdown-title">Logged in 5 min ago</div> -->
              <a href="features-profile.html" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
              <a href="features-activities.html" class="dropdown-item has-icon">
                <i class="fas fa-bolt"></i> Activities
              </a>
              <a href="features-settings.html" class="dropdown-item has-icon">
                <i class="fas fa-cog"></i> Settings
              </a>
              <div class="dropdown-divider"></div>
              <a href="Logout.php" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="">Nirav Shah</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="">NS</a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li <?php if (isset($Dashboard) == true || isset($AboutContact) == true) {
                  echo 'class="active"';
                } ?>><a href="index.php" class="nav-link"><i class="far fa-file-alt"></i><span>Dashboard/Form</span></a></li>

            <li class="menu-header">Contact</li>
            <li class="dropdown <?php if (isset($Contact) == true || isset($Export) == true) {
                                  echo "active";
                                } ?>">
              <a href="#" class="nav-link has-dropdown"><i class="far fa-user"></i><span>Contact</span></a>
              <ul class="dropdown-menu">
                <li <?php if (isset($Contact) == true) {
                      echo 'class="active"';
                    } ?>><a class="nav-link" href="Contact.php">All List</a></li>
                <li <?php if (isset($Export) == true) {
                      echo 'class="active"';
                    } ?>><a class="nav-link" href="Export.php">Export</a></li>
              </ul>
            </li>

          </ul>
        </aside>
      </div>