<?php
  if(isset($_POST['upload'])){
    $atn  = $_POST['atn'];
    $atn2 = $_POST['san_andere'];
    $id   = $_SESSION['uid'];
    $user = GD_fnc_getUser($id);
    $user = $user['vorname'] . " " . $user['nachname'];

    if(!file_exists("atns/". $id)) { mkdir("atns/". $id, 0777, true); }

    $temp = explode(".", $_FILES["atn_file"]["name"]);
    $newfilename = $atn . '.' . end($temp);
    move_uploaded_file($_FILES["atn_file"]["tmp_name"], "atns/". $id ."/" . $newfilename);
    $TOOL->query("UPDATE employee_ausbildugnen SET `$atn` = 2 WHERE id = $id");

    $to = "dennis.lemmermeier@karlsruhe.dlrg.de";
    $subject = "Neuer ATN-Upload";
    $txt = "$user hat soeben den ATN \"$atn\" im Management Tool hochgeladen!";
    $headers = "From: noreply@karlsruhe.dlrg.de";

    mail($to,$subject,$txt,$headers);
  }
?>
<div class="modal fade show" id="file_upload" style="padding-right: 17px;" aria-modal="true" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <h4 class="modal-title">Ausbildungsnachweis hochladen</h4>
        </div>
        <div class="modal-body">
          <blockquote class="quote-primary">
            Hier kannst du deine ATNS hochladen.
            Einfach im Dropdown die ATN auswählen und die Datei als PDF, JPG oder PNG (bevorzugt wird PDF) hochladen.
          </blockquote>

          <div class="input-group">
            <select name="atn" class="form-control" onchange="checkSanAndere(this.value)" required>
              <?php
                $id   = $_SESSION['uid'];
                $atns = $TOOL->query("SELECT * FROM employee_ausbildugnen WHERE id = $id")->fetch();
                foreach($atns as $atn);
              ?>
              <option hidden disabled selected>- - - - - ATN Auswählen - - - - -</option>
              <option value="331" <?php if(GD_fnc_atnFileExists("331")){ echo "hidden"; }; ?>>331 | Sanitätsausbildung A</option>
              <option value="332" <?php if(GD_fnc_atnFileExists("332")){ echo "hidden"; }; ?>>332 | Sanitätsausbildung B</option>
              <option value="san_andere" <?php if(GD_fnc_atnFileExists("san_andere")){ echo "hidden"; }; ?>> - - - | Höherwertige Sanitätsausbildung</option>
              <option value="152" <?php if(GD_fnc_atnFileExists("152")){ echo "hidden"; }; ?>>152 | Deutsches Rettungsschwimmabzeichen Silber</option>
              <option value="511" <?php if(GD_fnc_atnFileExists("511")){ echo "hidden"; }; ?>>511 | DLRG Bootsführerschein A</option>
              <option value="512" <?php if(GD_fnc_atnFileExists("512")){ echo "hidden"; }; ?>>512 | DLRG Bootsführerschein B</option>
              <option value="513" <?php if(GD_fnc_atnFileExists("513")){ echo "hidden"; }; ?>>513 | DLRG Bootsführerschein A/B</option>
              <option value="411" <?php if(GD_fnc_atnFileExists("411")){ echo "hidden"; }; ?>>411 | Fachausbildung Wasserrettungsdienst</option>
              <option value="431" <?php if(GD_fnc_atnFileExists("431")){ echo "hidden"; }; ?>>431 | Wachführer</option>
              <option value="812" <?php if(GD_fnc_atnFileExists("812")){ echo "hidden"; }; ?>>812 | Fachhelfer Baden-Württemberg</option>
              <option value="710" <?php if(GD_fnc_atnFileExists("710")){ echo "hidden"; }; ?>>710 | Unterweisung DLRG Betriebsfunk</option>
              <option value="712" <?php if(GD_fnc_atnFileExists("712")){ echo "hidden"; }; ?>>712 | BOS Sprechfunker (Analogfunk)</option>
              <option value="715" <?php if(GD_fnc_atnFileExists("715")){ echo "hidden"; }; ?>>715 | BOS Sprechfunker (Digitalfunk)</option>
              <option value="641" <?php if(GD_fnc_atnFileExists("641")){ echo "hidden"; }; ?>>641 | Signalmann</option>
              <option value="613" <?php if(GD_fnc_atnFileExists("613")){ echo "hidden"; }; ?>>613 | Einsatztaucher Stufe 2</option>
              <option value="1011" <?php if(GD_fnc_atnFileExists("1011")){ echo "hidden"; }; ?>>1011 | Strömungsretter Stufe 1</option>
              <option value="1028" <?php if(GD_fnc_atnFileExists("1028")){ echo "hidden"; }; ?>>1028 | Strömungsretter Stufe 2</option>
            </select>
          </div>
          <div class="input-group" style="display: none; width: 100%!important;" id="san">
            <br>
            <input type="text" class="form-control" name="san_andere" placeholder="Bezeichnung der Sanitätsausbildung" style="width: 100%!important;">
          </div>
          <br>
          <div class="input-group">
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="exampleInputFile" name="atn_file" required>
              <label class="custom-file-label" for="exampleInputFile">ATN-Nachweis auswählen</label>
            </div>
          </div>
          <br>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-outline-success float-right" name="upload" id="upload">Hochladen</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
    $(function () {
        bsCustomFileInput.init();
    });
    function checkSanAndere(x){
        jsActionConsoleLog(x, "info");
        if(x === 'san_andere'){
            document.getElementById('san').style.display = "block";
        } else {
            document.getElementById('san').style.display = "none";
        }
    }
</script>