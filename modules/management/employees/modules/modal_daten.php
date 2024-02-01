<?php
  if(isset($_POST['update_daten'])){
    $vorname  = $_POST['vorname'];
    $nachname = $_POST['nachname'];
    $email  = $_POST['email'];
    $phone    = $_POST['phone'];
    $bday     = $_POST['bday'];
    $TOOL->query("UPDATE employee_files SET vorname = '$vorname', nachname = '$nachname', email = '$email', phone = '$phone', bday = '$bday' WHERE id = $id");
    $t = 'Hat die Persönlichen Daten von <a href="?employee-file&id='.$id.'">'.$vorname.' '.$nachname.'</a> bearbeitet';
    GD_fnc_logIt($_SESSION['uid'], $t, 1);
    GD_fnc_reload();
  }
?>
<div class="modal fade" id="daten" style="padding-right: 17px;" aria-modal="true" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post" autocomplete="off">
        <div class="modal-header">
          <h4 class="modal-title">Persönliche Daten bearbeiten</h4>
        </div>
        <div class="modal-body">

          <div class="input-group">
            <input type="text" name="vorname" class="form-control" placeholder="Vorname" value="<?php echo $row['vorname'] ?>"> &nbsp;&nbsp;

            <input type="text" name="nachname" class="form-control" placeholder="Nachname" value="<?php echo $row['nachname'] ?>">
          </div>
          <br>
          <div class="input-group">
            <input type="text" name="email" class="form-control" placeholder="E-Mail" value="<?php echo $row['email'] ?>"> &nbsp;&nbsp;

            <input type="text" name="phone" class="form-control" placeholder="Telefonnummer" value="<?php echo $row['phone'] ?>">
          </div>
          <br>
          <div class="input-group">
            <div class="input-group-prepend" data-toggle="tooltip" data-placement="bottom" title="Geburstag">
              <span class="input-group-text"><i class="fa-solid fa-cake-candles"></i></span>
            </div>
            <input type="date" name="bday" class="form-control" placeholder="Geburstag" max="<?php echo date('Y-m-d', strtotime('-18 years'));?>" value="<?php echo $row['bday'] ?>">
            &nbsp;&nbsp;
            <input type="text" class="form-control" readonly>

          </div>
          <br>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-outline-success float-right" name="update_daten">Daten bearbeiten</button>
        </div>
      </form>
    </div>
  </div>
</div>