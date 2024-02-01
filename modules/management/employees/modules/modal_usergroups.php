<?php
if(isset($_POST['add_usergroup'])){
  $ugid       = $_POST['id'];
  $ug         = $TOOL->query("SELECT * FROM usergroups WHERE id = '$ugid'")->fetch();
  $members    = json_decode($ug['members']);
  if(!in_array($id, $members)) { $members[] = intval($id); }
  $members    = json_encode($members);
  $TOOL->query("UPDATE usergroups SET members = '$members' WHERE id = '$ugid'");
  $t = 'Hat <a href="?employee-file&id='.$id.'">'.$row['vorname'].' '.$row['nachname'].'</a> zur Benutzergruppe "<b class="text-muted">'.$ug['name'].'</b>" hinzugefügt';
  GD_fnc_logIt($_SESSION['uid'], $t, 1);
}

if(isset($_POST['remove_usergroup'])){
  $ugid       = $_POST['id'];
  $ug         = $TOOL->query("SELECT * FROM usergroups WHERE id = '$ugid'")->fetch();
  $members    = json_decode($ug['members']);
  if(in_array($id, $members)) {
    $key = array_search($id, $members);
    if ($key !== false) { unset($members[$key]); }
  }
  $members    = json_encode($members);
  $TOOL->query("UPDATE usergroups SET members = '$members' WHERE id = '$ugid'");
  $t = 'Hat <a href="?employee-file&id='.$id.'">'.$row['vorname'].' '.$row['nachname'].'</a> aus der Benutzergruppe "<b class="text-muted">'.$ug['name'].'</b>" entfernt';
  GD_fnc_logIt($_SESSION['uid'], $t, 1);
}


?>
<div class="modal fade" id="benutzergruppen" style="padding-right: 17px;" aria-modal="true" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Benutzergruppen bearbeiten</h4>
      </div>
      <div class="modal-body">

        <form method="post" autocomplete="off">
          <div class="input-group">
            <select name="id" class="form-control">
              <option value="" selected hidden>- - - - Benutzergruppe auswählen - - - -</option>
              <?php
              $res  = $TOOL->query("SELECT * FROM usergroups")->fetchAll(PDO::FETCH_ASSOC);
              foreach($res as $usergroup){
                var_dump(json_decode($usergroup['members'], true));
                if(!in_array($id, json_decode($usergroup['members'], true))){
                  $hide = ($usergroup['id'] == "admin" && !GD_fnc_checkAccess()) ? "hidden" : "";//
                  $hide = ($usergroup['id'] == "verwaltung"            AND !GD_fnc_checkAccess(array("verwaltung"))) ? "hidden" : $hide;
                  $hide = ($usergroup['id'] == "verwaltung-department" AND !GD_fnc_checkAccess(array("verwaltung"))) ? "hidden" : $hide;
              ?>
                <option value="<?php echo $usergroup['id'] ?>" <?php echo $hide; ?>><?php echo $usergroup['name'] ?></option>
              <?php
                }
              }
              ?>
            </select>
          </div>
          <div class="input-group">
            <button type="submit" class="btn btn-outline-success float-right" name="add_usergroup" style="margin-top: 0.5em!important;"> Benutzergruppe hinzufügen</button>
          </div>
        </form>

        <hr>

        <h5>Benutzergruppen des Users</h5>
        <ul style="list-style-type: none; padding-left: 0.5em;">
          <?php
          foreach ($res as $usergroup){
            if(in_array(intval($id), json_decode($usergroup['members'], true))){
          ?>
            <form method='post'>
              <input type='hidden' name='id' value="<?php echo $usergroup['id']; ?>">
              <li>
                <button type='submit' name='remove_usergroup' class='btn btn-outline-danger btn-xs' data-toggle='tooltip' data-placement='left' title='Aus Benutzergruppe entfernen'>
                  <i class='fa-solid fa-user-minus'></i>
                </button>&nbsp;&nbsp;
                <span data-toggle='tooltip' data-placement='right' title='<?php echo $usergroup['description']; ?>'><?php echo $usergroup['name']; ?></span>
              </li>
            </form>
          <?php
            }
          }
          ?>
        </ul>

      </div>
      <div class="modal-footer">
        <button class="btn btn-outline-secondary" data-toggle="modal-dismiss">Schließen</button>
      </div>
    </div>
  </div>
</div>