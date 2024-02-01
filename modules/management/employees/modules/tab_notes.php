<?php
if(isset($_POST['newNote']) OR isset($_POST['changenote'])){
  $titel  = $_POST['title'];
  $detail = $_POST['detail'];
  $status = $_POST['status'];
  $art    = $_POST['art'];
  $member = $_SESSION['uid'];

  if(isset($_POST['newNote'])){
    $TOOL->query("INSERT INTO employee_notes (zugew, titel, detail, art, status, member) VALUES ('$id', '$titel', '$detail', '$art', '$status', '$member')");
  }
  if(isset($_POST['changenote'])){
    $TOOL->query("UPDATE employee_notes SET titel = '$titel', detail = '$detail', art = '$art', status = '$status' WHERE zugew = '$id'");
  }
}


?>
<style>
  td { vertical-align: middle!important; }
</style>
<button data-toggle="modal" data-target="#newNote" class="btn btn-outline-success btn-xs"><i class="fas fa-plus"></i> Neue Notiz</button><br>
<table class="table table-border table-striped">
  <thead>
  <tr>
    <th>Art</th>
    <th>Titel</th>
    <th>Mitarbeiter</th>
    <th>Status</th>
    <th>Zeitpunkt</th>
    <th></th>
  </tr>
  <?php
  $stmt = $TOOL->query("SELECT * FROM employee_notes WHERE zugew = '$id' AND status in('1', '2', '3', '4')")->fetchAll(PDO::FETCH_ASSOC);
  foreach($stmt as $n){
    $nid = $n['id'];

    if(isset($_POST["changenote_$nid"])){
      $titel  = $_POST["title_$nid"];
      $detail = $_POST["detail_$nid"];
      $status = $_POST["status_$nid"];
      $art    = $_POST["art_$nid"];
      $member = $_SESSION['uid'];

      $TOOL->query("UPDATE employee_notes SET titel = '$titel', detail = '$detail', art = '$art', status = '$status' WHERE zugew = '$id' AND id = $nid");
      echo "<script>window.location = window.location.href;</script>";
    }
    ?>
    <tr>
      <td>
        <?php
        echo $n['art'] == '1' ? "<span class='text-info'>Bemerkung</span>" : "";  echo $n['art'] == '2' ? "<span class='text-warning'>Wichtige Information</span>" : "";
        echo $n['art'] == '3' ? "<span class='text-success'>Belobigung</span>" : ""; echo $n['art'] == '4' ? "<span class='text-lp-red'>Beschwerde</span>" : "";
        ?>
      </td>
      <td><?php echo $n['titel']; ?></td>
      <td><?php echo GD_fnc_getUser($n['member'])['vorname'] . " " . GD_fnc_getUser($n['member'])['nachname']; ?></td>
      <td>
        <?php
        echo $n['status'] == '1' ? "Offen" : "";              echo $n['status'] == '2' ? "in Bearbeitung" : "";
        echo $n['status'] == '3' ? "Warte auf Gespräch" : ""; echo $n['status'] == '4' ? "Abgeschlossen" : "";
        ?>
      </td>
      <td><?php echo date('d.m.Y H:i', strtotime($n['create_date'])); ?> Uhr</td>
      <td>
        <a class="btn btn-outline-info" data-toggle="modal" data-target="#note_<?php echo $nid; ?>">
          <i class="fa-solid fa-folder-open"></i>
        </a>
      </td>
    </tr>
    <div class="modal fade show" id="note_<?php echo $nid; ?>" style="display: none; padding-right: 17px;" aria-modal="true" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form method="post">
            <div class="modal-header">
              <h4 class="modal-title">Mitarbeiternotiz #<?php echo $nid; ?> | <?php echo $n['titel']; ?></h4>
            </div>
            <div class="modal-body">
              <select class="form-control" name="art_<?php echo $nid; ?>" id="art_<?php echo $nid; ?>" disabled>
                <option value='1' <?php echo $n['art'] == '1' ? "selected" : ""; ?>>Bemerkung</option>
                <option value='2' <?php echo $n['art'] == '2' ? "selected" : ""; ?>>Wichtige Information</option>
                <option value='3' <?php echo $n['art'] == '3' ? "selected" : ""; ?>>Belobigung</option>
                <option value='4' <?php echo $n['art'] == '4' ? "selected" : ""; ?>>Beschwerde</option>
              </select>
              <br>
              <select class="form-control" name="status_<?php echo $nid; ?>" id="status_<?php echo $nid; ?>" disabled>
                <option value='1' <?php echo $n['status'] == '1' ? "selected" : ""; ?>>Offen</option>
                <option value='2' <?php echo $n['status'] == '2' ? "selected" : ""; ?>>in Bearbeitung</option>
                <option value='3' <?php echo $n['status'] == '3' ? "selected" : ""; ?>>Warte auf Gespräch</option>
                <option value='4' <?php echo $n['status'] == '4' ? "selected" : ""; ?>>Abgeschlossen</option>
                <option value='5' <?php echo $n['status'] == '5' ? "selected" : ""; ?>>Eintrag Löschen</option>
              </select>
              <br>
              <input type="text" class="form-control" name="title_<?php echo $nid; ?>" id="title_<?php echo $nid; ?>" value="<?php echo $n['titel']; ?>" readonly>
              <br>
              <textarea name="detail_<?php echo $nid; ?>" id="detail_<?php echo $nid; ?>" cols="30" rows="5" class="form-control" readonly><?php echo $n['detail']; ?></textarea>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="submit" data-dismiss="modal" class="btn btn-secondary">Schließen</button>
              <div class="icheck-success">
                <input type="checkbox" id="edit_<?php echo $nid; ?>" onchange="edti_<?php echo $nid; ?>(this.checked)">
                <label for="edit_<?php echo $nid; ?>">Bearbeiten</label>
              </div>
              <button type="submit" class="btn btn-outline-danger" name="changenote_<?php echo $nid; ?>" id="changenote_<?php echo $nid; ?>" disabled>Speichern</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <script>
        function edti_<?php echo $nid; ?>(x){
            if(x){
                document.getElementById("changenote_<?php echo $nid; ?>").disabled = false;
                document.getElementById("art_<?php echo $nid; ?>").disabled = false;
                document.getElementById("status_<?php echo $nid; ?>").disabled = false;
                document.getElementById("detail_<?php echo $nid; ?>").removeAttribute('readonly');
                document.getElementById("title_<?php echo $nid; ?>").removeAttribute('readonly');
            } else {
                document.getElementById("changenote_<?php echo $nid; ?>").disabled = true;
                document.getElementById("art_<?php echo $nid; ?>").disabled = true;
                document.getElementById("status_<?php echo $nid; ?>").disabled = true;
                document.getElementById("detail_<?php echo $nid; ?>").readOnly = true;
                document.getElementById("title_<?php echo $nid; ?>").readOnly = true;
            }
        }
    </script>
    <?php
  }
  ?>
  </thead>
</table>


<div class="modal fade show" id="newNote" style="display: none; padding-right: 17px;" aria-modal="true" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="post">
        <div class="modal-header">
          <h4 class="modal-title">Neue Mitarbeiternotiz</h4>
        </div>
        <div class="modal-body">
          <select class="form-control" name="art" id="art">
            <option value='1'>Bemerkung</option>
            <option value='2'>Wichtige Information</option>
            <option value='3'>Belobigung</option>
            <option value='4'>Beschwerde</option>
          </select>
          <br>
          <select class="form-control" name="status" id="status">
            <option value='1'>Offen</option>
            <option value='2'>in Bearbeitung</option>
            <option value='3'>Warte auf Gespräch</option>
            <option value='4'>Abgeschlossen</option>
          </select>
          <br>
          <input type="text" class="form-control" name="title" id="title" placeholder="Titel">
          <br>
          <textarea name="detail" id="detail" cols="30" rows="5" class="form-control" placeholder="Details"></textarea>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="submit" data-dismiss="modal" class="btn btn-secondary">Schließen</button>

          <button type="submit" class="btn btn-outline-danger" name="newNote" id="changenote">Speichern</button>
        </div>
      </form>
    </div>
  </div>
</div>


