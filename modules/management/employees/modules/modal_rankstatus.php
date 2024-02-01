<?php
if(isset($_POST['update_rangstatus'])){
  $dept   = GD_fnc_checkSetting("departments") ? $_POST['department'] : 1;
  $rank   = $_POST['rank'];
  $status = $_POST['status'];
  $v      = $row['vorname'];
  $n      = $row['nachname'];

  if($dept != $row['department']){
    $TOOL->query("UPDATE employee_files SET department = $dept WHERE id = $id");
    $t = 'Hat die Departmentzugehörigkeit des Mitarbeiters <a href="?employee-file&id='.$id.'">'.$v.' '.$n.'</a> von <b>' . GD_fnc_getDepartmentName($row['department']) . '</b> </b> auf <b>' . GD_fnc_getDepartmentName($dept) . '</b> geändert';
    GD_fnc_logIt($_SESSION['uid'], $t, 1);
    $updateusergroups = true;
    sleep(1);
  }

  if($dept != $row['department'] AND $rank == $row['rank']){
    $t = '<a href="?employee-file&id='.$id.'">'.$v.' '.$n.'</a> ist nun durch die Department-Änderung nun <b>' . GD_fnc_getRankName($rank, $dept).'</b>';
    GD_fnc_logIt($_SESSION['uid'], $t, 1);
    $updateusergroups = true;
    sleep(1);
  }

  if($rank != $row['rank']){
    $TOOL->query("UPDATE employee_files SET `rank` = $rank WHERE id = $id");
    $t = 'Hat den Rang des Mitarbeiters <a href="?employee-file&id='.$id.'">'.$v.' '.$n.'</a> von <b>' . GD_fnc_getRankName($row['rank'], $row['department']) . '</b> </b> auf <b>' . GD_fnc_getRankName($rank, $dept) . '</b> geändert';
    GD_fnc_logIt($_SESSION['uid'], $t, 1);
    $updateusergroups = true;
    sleep(1);
  }

  if($status != $row['status']){
    $TOOL->query("UPDATE employee_files SET `status` = $status WHERE id = $id");
    $t = 'Hat den Status des Mitarbeiters <a href="?employee-file&id='.$id.'">'.$v.' '.$n.'</a> von <b>' . GD_fnc_getStatus($row['status']) . '</b> </b> auf <b>' . GD_fnc_getStatus($status) . '</b> geändert';
    GD_fnc_logIt($_SESSION['uid'], $t, 1);
  }

  if($updateusergroups){
    GD_fnc_usergroupByRank($rank, $dept, $id);
  }

  GD_fnc_reload();
}
?>
<div class="modal fade" id="rangstatus" style="padding-right: 17px;" aria-modal="true" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post" autocomplete="off">
        <div class="modal-header">
          <h4 class="modal-title">Persönliche Daten bearbeiten</h4>
        </div>
        <div class="modal-body">

          <?php if(GD_fnc_checkSetting("departments")){ ?>
            <div class="input-group">
              <select name="department" class="form-control" onchange="updateRanks(this.value, <?php echo $row['rank'] ?>)">
              <?php
                $dept = $TOOL->query("SELECT * FROM settings_departments")->fetchAll(PDO::FETCH_ASSOC);
                foreach ($dept as $dept){
              ?>
                  <option value="<?php echo $dept['id'] ?>" <?php echo $dept['id'] == $row['department'] ? "selected" : ""; ?>><?php echo $dept['name'] ?></option>
              <?php
                }
              ?>
              </select>
            </div>
            <br>
          <?php } ?>

          <div class="input-group" id="ranks">
            <select name="rank" class="form-control">
              <?php
              $rank = $TOOL->query("SELECT * FROM settings_ranks WHERE department = " . $row['department'])->fetchAll(PDO::FETCH_ASSOC);
              foreach ($rank as $rank){
                ?>
                <option value="<?php echo $rank['rank'] ?>" <?php echo $rank['rank'] == $row['rank'] ? "selected" : ""; ?>><?php echo $rank['name'] ?></option>
                <?php
              }
              ?>
            </select>
          </div>
          <br>

          <div class="input-group">
            <select name="status" class="form-control">
              <?php
              for($i = 1; $i <= 7; $i++){
                ?>
                <option value="<?php echo $i ?>" <?php echo $i == $row['status'] ? "selected" : ""; ?>><?php echo GD_fnc_getStatus($i) ?></option>
                <?php
              }
              ?>
            </select>
          </div>
          <br>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-outline-success float-right" name="update_rangstatus">Rang / Status bearbeiten</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  function updateRanks(d, r){
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'modules/management/employees/modules/XMLHttpRequest.php?d='+d+'&r='+r, true);
    jsActionConsoleLog('modules/management/employees/modules/XMLHttpRequest.php?d='+d+'&r='+r, 'info');
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onload = function() {
      document.getElementById("ranks").innerHTML = xhr.responseText;
    };

    xhr.onerror = function() {
      jsActionConsoleLog("XMLHttpRequest - Etwas ist schiefgelaufen", "error");
    };
    xhr.send();
  }
</script>