<?php
  include $_SERVER['DOCUMENT_ROOT'] . "/modules/misc/modal_file_upload.php";
?>
<footer class="main-footer">
  <strong>Copyright © 2023 <a href="https://karlsruhe.dlrg.de" class="text-info">DLRG Stadtgruppe Karlsruhe</a>.</strong>
  All rights reserved.
  <div class="float-right d-none d-sm-inline-block">
    <b>Version</b> 1.0
  </div>
</footer>
<div id="sidebar-overlay"></div>
</div>


<script src="https://adminlte.io/themes/v3/plugins/jquery/jquery.min.js"></script>

<script src="https://adminlte.io/themes/v3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="https://adminlte.io/themes/v3/dist/js/adminlte.js?v=3.2.0"></script>

<script src="https://adminlte.io/themes/v3/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="https://adminlte.io/themes/v3/plugins/raphael/raphael.min.js"></script>
<script src="https://adminlte.io/themes/v3/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="https://adminlte.io/themes/v3/plugins/jquery-mapael/maps/usa_states.min.js"></script>

<script src="https://adminlte.io/themes/v3/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<script src="https://adminlte.io/themes/v3/plugins/toastr/toastr.min.js"></script>

<script src="https://adminlte.io/themes/v3/plugins/chart.js/Chart.min.js"></script>

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    function checkPw(){
        let x = document.getElementById('password1').value;
        let y = document.getElementById('password2').value;

        if(x == y){
            document.getElementById('firstPW').disabled = false;
            document.getElementById('notSame').innerHTML = "";
        } else {
            document.getElementById('firstPW').disabled = true;
            document.getElementById('notSame').innerHTML = "<span class='text-lp-red'>Die Passwörter stimmen nicht überein!</span>";
        }
    }
</script>


</body>
</html>
<?php
  echo isset($_SESSION['Start123']) ? '<style>body { overflow: hidden; }</style>' : '';

  if(isset($_POST['firstPW'])){
    $pw  = $_POST['password2'];
    $pw2 = password_hash($_POST['password2'], PASSWORD_DEFAULT);
    $id  = $_SESSION['uid'];
    $data = json_decode($_COOKIE['GD_SAPD_LOGIN'], true);
    if($_POST['remember'] == "remember"){ setcookie("GD_SAPD_LOGIN", json_encode(array($data[0], $pw)), time() + 3600 * 24 * 365); }
    $stmt = $TOOL->query("UPDATE logindaten SET password = '$pw2' WHERE id = '$id'");
    echo "<script>toastr.success('Dein neues Passwort wurde erfolgreich gesetzt!')</script>";
    phpActionJSLog("Neues Passwort gesetzt!", "info");
    unset($_SESSION['Start123']);
  }
?>

<div class="modal fade" id="first" style="padding-right: 17px;" aria-modal="true" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="post">
        <div class="modal-header">
          <h4 class="modal-title">Dein erster Login!</h4>
        </div>
        <div class="modal-body">
          <blockquote class="quote-danger">
            Herzlich Willkommen <b><?php echo $USER['vorname']; ?> <?php echo $USER['nachname']; ?></b>,<br>
            Um unsere Tools so sicher wie möglich zu gestalten, bitten wir dich hier nun dein eigenes Passwort zu vergeben.<br><br>
            Fehler können über den Bugreporter (oben rechts auf deinen Namen klicken) dem DEV-Team gemeldet werden.
          </blockquote>

          <div class="input-group">
            <input type="text" name="password1" id="password1" class="form-control" onkeydown="checkPw()" onkeyup="checkPw()" placeholder="Passwort eingeben">
          </div>
          <br>
          <div class="input-group">
            <input type="text" name="password2" id="password2" class="form-control" onkeydown="checkPw()" onkeyup="checkPw()" placeholder="Passwort erneut eingeben">
          </div>
          <br>
          <div class="input-group">
            <input type="hidden" name="remember" value="">
            <div class="icheck-success">
              <input type="checkbox" id="remember" name="remember" value="remember">
              <label for="remember" style="color: #ECECE7!important;">
                An mich erinnern
              </label>
            </div>
          </div>
          <br>
          <div class="input-group" id="notSame"></div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-outline-success float-right" name="firstPW" id="firstPW" disabled>Neues Passwort speichern</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php
  if(isset($_SESSION['Start123'])){
    ?>
    <script>
        $(document).ready(function () {
            $('#first').modal('show');
        });
    </script>
    <?php
  }
?>