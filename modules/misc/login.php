<?php
  if(isset($_POST['login']) OR isset($_COOKIE['GD_SAPD_LOGIN'])){
      $data = json_decode($_COOKIE['GD_SAPD_LOGIN'], true);
      $u = !empty($_POST) ? $_POST['username'] : $data[0];
      $p = !empty($_POST) ? $_POST['password'] : $data[1];
      $c = empty($_POST) || isset($_POST['coockie']);

    if(DG_fnc_login($u, $p, $c)){
      phpActionJSLog("Erfolgreich eingeloggt", "success");
      echo "<script>window.location.href = '?dashboard';</script>";
    } else {
      phpActionJSLog("Login fehlgeschlagen!", "error");
      $error = "<span class='text-danger'>Benutzername oder Passwort ist falsch!</span>";
    }
  }

  if(isset($_SESSION['valid_login'])){
    echo "<script>window.location.href = '?dashboard'</script>";
  }

?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo stringtable('STR_HEADER_LOGIN') ?></title>

  <link rel="icon" type="image/x-icon" href="<?php echo linktable('LINK_FAVICON') ?>">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/fontawesome-free/css/all.min.css">

  <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

  <link rel="stylesheet" href="/inc/customcss/main.css">


  <link rel="stylesheet" href="https://adminlte.io/themes/v3/dist/css/adminlte.min.css?v=3.2.0">
<body class="hold-transition login-page dark-mode custom_background">
<div class="login-box">

  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <h1><?php echo stringtable('STR_LOGIN_PROJECT') ?></h1>
      <h4><small><?php echo stringtable('STR_LOGIN_FACTION') ?></small></h4>
    </div>
    <div class="card-body">
      <p class="login-box-msg"><?php echo $error ?? stringtable('STR_LOGIN_INFOTEXT') ?></p>
      <form method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="username" placeholder="Dienstnummer">
          <div class="input-group-append">
            <div class="input-group-text text-center" style="width: 2.5em!important; justify-content: center!important;">
              <i class="fas fa-id-card"></i>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Passwort">
          <div class="input-group-append">
            <div class="input-group-text text-center" style="width: 2.5em!important; justify-content: center!important;">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember" name="coockie">
              <label for="remember">
                an mich erinnern
              </label>
            </div>
          </div>

          <div class="col-4">
            <button type="submit" name="login" class="btn btn-primary btn-block">einloggen</button>
          </div>

        </div>
      </form>

      <p class="mb-1">
        <hr><a href="" class="text-danger">Ich habe mein Passwort vergessen</a><hr>
      </p>
      <p class="mb-1 text-center text-muted">
        <strong>Copyright © 2023 <a href="https://klgil.de" target="_blank" class="text-info">Gil_ <span class="text-muted">&</span> Dennis</a>.</strong><br>
        All rights reserved.
      </p>
    </div>

  </div>

</div>


<script src="https://adminlte.io/themes/v3/plugins/jquery/jquery.min.js"></script>

<script src="https://adminlte.io/themes/v3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="https://adminlte.io/themes/v3/dist/js/adminlte.min.js?v=3.2.0"></script>
</body>
</html>
