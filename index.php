<?php
  // Hole dir die Functions und die Datenbanken
    include "inc/Config_Master.php";

  // Speichere die anzuzeigende Seite
    $page = !empty($_GET) ? key($_GET) : "login" ;

  // Logout Funktion
    if($page == "logout"){ session_unset(); session_destroy(); setcookie("GD_SAPD_LOGIN", '', time() - 3600, '/'); }

  // Setze den Header wenn es sich nicht um die Loginseite handelt, wenn es sich um die Loginseite handelt, setze den ?login
    include $page != "login" ? $_SERVER['DOCUMENT_ROOT'] . "/inc/header.php" : '<script>window.history.pushState({ path: newURL }, "", window.location.origin + "/?login");</script>';

    //Hole dir den Dateipfad aus der Datenbank
      $path = $TOOL->query("SELECT path FROM settings_filepaths WHERE urlkey = '$page'")->fetch()['path'];

    // Include dir die gewünschte seite
      include $path != null ? $path : "modules/misc/404.php";

  // Setze den Footer wenn es sich nicht um die Loginseite handelt
    include $page != "login" ? $_SERVER['DOCUMENT_ROOT'] . "/inc/footer.php" : '';
