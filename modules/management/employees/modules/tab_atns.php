<?php
if(isset($_POST['edit'])){
  $atn = $_POST['atn'];
  $s   = $_POST['status'];
  $TOOL->query("UPDATE employee_ausbildugnen SET `$atn` = $s WHERE id = $id");
}


?>
<style>
  td, th { vertical-align: middle!important; }
  .atn { width: 8em!important; text-align: center; }
  .file { width: 2em!important; text-align: center; font-size: 14pt; }
  .name { width: 18em!important; }

</style>

<table class="table table-border table-striped">
  <thead>
    <tr>
      <th>ATN-Nummer</th>
      <th>ATN-Name</th>
      <th>Datei</th>
      <th>Status</th>
      <th>
        <a data-target="#edit" data-toggle="modal" class="btn btn-outline-success btn-xs">ATN bearbeiten</a>
      </th>
    </tr>
  </thead>
  <tbody>
    <?php
      $atn = $TOOL->query("SELECT * FROM employee_ausbildugnen WHERE id = $id")->fetch();
    ?>
    <tr>
      <td class="atn">331</td>
      <td class="name">Sanitätsausbildung A</td>
      <td class="file"><?php echo GD_getATNFiles("331", $id) ?></td>
      <td><?php echo GD_getATN("331", $id) ?></td>
      <td></td>
    </tr>
    <tr>
      <td class="atn">332</td>
      <td class="name">Sanitätsausbildung B</td>
      <td class="file"><?php echo GD_getATNFiles("332", $id) ?></td>
      <td><?php echo GD_getATN("332", $id) ?></td>
      <td></td>
    </tr>
    <tr>
      <td class="atn">- - -</td>
      <td class="name">Höherwertige med. Ausbildung</td>
      <td class="file"><?php echo GD_getATNFiles("san_andere", $id) ?></td>
      <td><?php echo $atn['san_andere'] != "" ? "<span class='text-success'>".$atn['san_andere']."</span>" : "<i class='text-muted'>nicht vorhanden</i>" ?></td>
      <td></td>
    </tr>
    <tr>
      <td class="atn">152</td>
      <td class="name">DRSA-Silber</td>
      <td class="file"><?php echo GD_getATNFiles("152", $id) ?></td>
      <td><?php echo GD_getATN("152", $id) ?></td>
      <td></td>
    </tr>
    <tr>
      <td class="atn">511</td>
      <td class="name">DLRG Bootsführerschein A</td>
      <td class="file"><?php echo GD_getATNFiles("511", $id) ?></td>
      <td><?php echo GD_getATN("511", $id) ?></td>
      <td></td>
    </tr>
    <tr>
      <td class="atn">513</td>
      <td class="name">DLRG Bootsführerschein A/B</td>
      <td class="file"><?php echo GD_getATNFiles("513", $id) ?></td>
      <td><?php echo GD_getATN("513", $id) ?></td>
      <td></td>
    </tr>
    <tr>
      <td class="atn">411</td>
      <td class="name">Fachausbildung Wasserrettungsdienst</td>
      <td class="file"><?php echo GD_getATNFiles("411", $id) ?></td>
      <td><?php echo GD_getATN("411", $id) ?></td>
      <td></td>
    </tr>
    <tr>
      <td class="atn">812</td>
      <td class="name">Fachhelfer Baden-Württemberg</td>
      <td class="file"><?php echo GD_getATNFiles("812", $id) ?></td>
      <td><?php echo GD_getATN("812", $id) ?></td>
      <td></td>
    </tr>
    <tr>
      <td class="atn">710</td>
      <td class="name">Unterweisung DLRG Betriebsfunkt</td>
      <td class="file"><?php echo GD_getATNFiles("710", $id) ?></td>
      <td><?php echo GD_getATN("710", $id) ?></td>
      <td></td>
    </tr>
    <tr>
      <td class="atn">712</td>
      <td class="name">BOS Sprechfunker (Analog)</td>
      <td class="file"><?php echo GD_getATNFiles("712", $id) ?></td>
      <td><?php echo GD_getATN("712", $id) ?></td>
      <td></td>
    </tr>
    <tr>
      <td class="atn">715</td>
      <td class="name">BOS Sprechfunker (Digital)</td>
      <td class="file"><?php echo GD_getATNFiles("715", $id) ?></td>
      <td><?php echo GD_getATN("715", $id) ?></td>
      <td></td>
    </tr>
    <tr>
      <td class="atn">641</td>
      <td class="name">Signalmann</td>
      <td class="file"><?php echo GD_getATNFiles("641", $id) ?></td>
      <td><?php echo GD_getATN("641", $id) ?></td>
      <td></td>
    </tr>
    <tr>
      <td class="atn">613</td>
      <td class="name">Einsatztaucher Stufe 2</td>
      <td class="file"><?php echo GD_getATNFiles("613", $id) ?></td>
      <td><?php echo GD_getATN("613", $id) ?></td>
      <td></td>
    </tr>
    <tr>
      <td class="atn">1011</td>
      <td class="name">Strömungsretter Stufe 1</td>
      <td class="file"><?php echo GD_getATNFiles("1011", $id) ?></td>
      <td><?php echo GD_getATN("1011", $id) ?></td>
      <td></td>
    </tr>
    <tr>
      <td class="atn">1028</td>
      <td class="name">Strömungsretter Stufe 2</td>
      <td class="file"><?php echo GD_getATNFiles("1028", $id) ?></td>
      <td><?php echo GD_getATN("1028", $id) ?></td>
      <td></td>
    </tr>
    <tr>
      <td class="atn">431</td>
      <td class="name">Wachführer</td>
      <td class="file"><?php echo GD_getATNFiles("431", $id) ?></td>
      <td><?php echo GD_getATN("431", $id) ?></td>
      <td></td>
    </tr>

  </tbody>
</table>

<div class="modal fade show" id="edit" style="display: none; padding-right: 17px;" aria-modal="true" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post">
        <div class="modal-header">
          <h4 class="modal-title">ATN'S bearbeiten</h4>
        </div>
        <div class="modal-body">
          <div class="input-group">
            <select name="atn" class="form-control" onchange="editATNStatus(this.value, <?php echo $id; ?>)">
              <option hidden disabled selected>- - - - - - - - - - ATN Auswählen - - - - - - - - - -</option>
              <option value="331">331 | Sanitätsausbildung A</option>
              <option value="332">332 | Sanitätsausbildung B</option>
              <option value="san_andere">----- | Höherwertige Sanitätsausbildung</option>
              <option value="152">152 | Deutsches Rettungsschwimmabzeichen Silber</option>
              <option value="511">511 | DLRG Bootsführerschein A</option>
              <option value="512">512 | DLRG Bootsführerschein B</option>
              <option value="513">513 | DLRG Bootsführerschein A/B</option>
              <option value="411">411 | Fachausbildung Wasserrettungsdienst</option>
              <option value="431">431 | Wachführer</option>
              <option value="812">812 | Fachhelfer Baden-Württemberg</option>
              <option value="710">710 | Unterweisung DLRG Betriebsfunk</option>
              <option value="712">712 | BOS Sprechfunker (Analogfunk)</option>
              <option value="715">715 | BOS Sprechfunker (Digitalfunk)</option>
              <option value="641">641 | Signalmann</option>
              <option value="613">613 | Einsatztaucher Stufe 2</option>
              <option value="1011">1011 | Strömungsretter Stufe 1</option>
              <option value="1028">1028 | Strömungsretter Stufe 2</option>
            </select>
          </div>
          <div id="editResponse"></div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="submit" data-dismiss="modal" class="btn btn-secondary">Schließen</button>

          <button type="submit" class="btn btn-outline-success" name="edit">Speichern</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
    function editATNStatus(d, i){
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'modules/misc/XMLHttpRequest.php?d='+d+'&uid='+i, true);
        jsActionConsoleLog('modules/misc/XMLHttpRequest.php?d='+d+'&uid='+i, 'info');
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onload = function() {
            jsActionConsoleLog(xhr.responseText, 'info');
            document.getElementById("editResponse").innerHTML = xhr.responseText;
        };

        xhr.onerror = function() {
            jsActionConsoleLog("XMLHttpRequest - Etwas ist schiefgelaufen", "error");
        };
        xhr.send();
    }
</script>
