<?php
  if(!isset($_SESSION['valid_login'])){
    echo "<script>window.location.href = '?login'</script>";
  }

  $USER = $TOOL->query("SELECT * FROM employee_files WHERE id = ".$_SESSION['uid'])->fetch();
?>
<html lang="de" style="height: auto;">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo stringtable('STR_HEADER_MAIN') ?></title>

  <link rel="icon" type="image/x-icon" href="<?php echo linktable('LINK_FAVICON') ?>">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">

  <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

  <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/toastr/toastr.min.css">

  <link rel="stylesheet" href="https://adminlte.io/themes/v3/dist/css/adminlte.min.css?v=3.2.0">

  <script src="https://kit.fontawesome.com/83ac655303.js" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="/inc/customcss/main.css">
</head>
<body class="dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed" style="height: auto;">
<div class="wrapper">

  <nav class="main-header navbar navbar-expand navbar-dark">

    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="?dashboard" class="nav-link">Home</a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
          <img src='<?php echo linktable('LINK_USERPLACEHOLDER') ?>'class="user-image img-circle elevation-2">
          <?php echo $USER['vorname'] . " " . $USER['nachname']; ?>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- User image -->
          <li class="user-header bg-secondary">
            <img src='<?php echo linktable('LINK_USERPLACEHOLDER') ?>' class="img-circle elevation-2">
            <p>
              <?php echo GD_fnc_getRankName($USER['rank'], $USER['department']); ?>
              <small>Ressort <?php echo GD_fnc_getDepartmentName($USER['department']); ?></small>
            </p>
          </li>
          <!-- Menu Footer-->
          <li class="user-footer justify-content-center">
            <a data-toggle="modal" data-target="#file_upload" class="btn btn-default btn-flat">ATN hochladen</a>
            <a href="?logout" class="btn btn-default btn-flat float-right">Ausloggen</a>
          </li>
        </ul>
      </li>
    </ul>
  </nav>

  <aside class="main-sidebar sidebar-dark-primary elevation-4">

    <span class="brand-link">
      <img src="<?php echo linktable('LINK_LOGO_ROUND') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><?php echo stringtable('STR_SIDEBAR_PROJECT') ?></span>
    </span>

    <div class="sidebar" data-np-autofill-form-type="other" data-np-checked="1" data-np-watching="1">

      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo linktable('LINK_LOGO_FACTION') ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info text-center" style="vertical-align: middle!important; padding-left: 2em!important;">
          <span class="d-block text-sm"
                style="<?php echo str_contains(stringtable('STR_HEADER_FACTION'), "<br>") ? "margin-top: -0.7em!important; margin-bottom: -1.5em!important;" : "" ?>">
            <?php echo stringtable('STR_HEADER_FACTION') ?></span>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item">
            <a href="?dashboard" class="nav-link <?php GD_fnc_activeItem("dashboard"); ?>">
              <i class="nav-icon fa-solid fa-grid"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <?php if(GD_fnc_checkAccess(array("kasse", "ressortleitung"))){ ?>
          <li class="nav-item <?php GD_fnc_activeDropdown(array("employees","usergroups", "employee-file", "logfiles", "ranks")); ?>">
            <a href="#" class="nav-link <?php GD_fnc_activeItem(array("employees","usergroups", "employee-file", "logfiles", "ranks"), true); ?>">
              <i class="nav-icon fa-solid fa-people-roof"></i>
              <p>
                Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="margin-left: 0.5em!important;">
              <li class="nav-item">
                <a href="?employees" class="nav-link <?php GD_fnc_activeItem(array("employees", "employee-file")); ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Mitgliederverzeichnis</p>
                </a>
              </li>
              <?php if(GD_fnc_checkAccess()){ ?>
              <li class="nav-item">
                <a href="?usergroups" class="nav-link <?php GD_fnc_activeItem(array("usergroups")); ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Benutzergruppen</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?ranks" class="nav-link <?php GD_fnc_activeItem(array("ranks")); ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ränge</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?logfiles" class="nav-link <?php GD_fnc_activeItem(array("logfiles")); ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Logs</p>
                </a>
              </li>
              <?php } ?>
            </ul>
          </li>
          <?php } ?>

          <?php if(GD_fnc_checkAccess(array("kasse", "ressortleitung"))){ ?>
            <li class="nav-item <?php GD_fnc_activeDropdown(array("artikelliste", "artikel-detail","artikel")); ?>">
              <a href="#" class="nav-link <?php GD_fnc_activeItem(array("artikelliste", "artikel-detail","artikel"), true); ?>">
                <i class="nav-icon fa-solid fa-warehouse"></i>
                <p>
                  Lager
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" style="margin-left: 0.5em!important;">
                <li class="nav-item">
                  <a href="?artikelliste" class="nav-link <?php GD_fnc_activeItem(array("artikelliste", "artikel-detail","artikel")); ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Artikel Liste</p>
                  </a>
                </li>
              </ul>
            </li>
          <?php } ?>

          <br>
          <?php if($_SESSION['uid'] == 1){ ?>
            <li class="nav-item">
              <a href="?debug" class="nav-link <?php GD_fnc_activeItem(array("debug")); ?>">
                <i class="fa-solid fa-bug nav-icon"></i>
                <p>Debug</p>
              </a>
            </li>
          <?php } ?>

          <?php if($_SESSION['uid'] == 1){ ?>
            <li class="nav-item">
              <a href="?settings-main" class="nav-link <?php GD_fnc_activeItem(array("settings-main", "settings-filepath", "settings-stringtable", "settings-linktable")); ?>">
                <i class="fas fa-cogs nav-icon"></i>
                <p>Einstellungen</p>
              </a>
            </li>
          <?php } ?>

        </ul>
      </nav>

    </div>

  </aside>