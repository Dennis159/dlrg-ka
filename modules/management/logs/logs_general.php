<?php
if(isset($_POST['save_new'])){
  $urlkey      = $_POST['urlkey'];
  $path        = $_POST['path'];
  $description = $_POST['description'];

  $TOOL->query("INSERT INTO settings_filepaths (urlkey, path, description) VALUES ('$urlkey', '$path', '$description')");
  $t = 'Hat einen Dateipfad für die Seite \"' . $urlkey . '\" erstellt';
  GD_fnc_logIt($_SESSION['uid'], $t, 1);
}
?>
<div class="content-wrapper">

  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Logs</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item">Management</li>
            <li class="breadcrumb-item active">Logs</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">

      <div class="card">
         <div class="card-body">
          <table class="table table-striped table hover">
            <thead>
            <tr>
              <th>Benutzer</th>
              <th>Aktion</th>
              <th>Zeitpunkt</th>
            </tr>
            </thead>
            <?php
            $res = $TOOL->query("SELECT * FROM logs_global ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
            foreach($res as $row){
              ?>
              <tr>
                <td><?php $u = GD_fnc_getUser($row['user']); echo $u['vorname'] . " " . $u['nachname']; ?></td>
                <td><?php echo $row['text'] ?></td>
                <td><?php echo date('d.m.Y H:i:s', strtotime($row['created_at']));?> Uhr</td>
              </tr>
              <?php
            }
            ?>
          </table>
        </div>
      </div>


    </div>
  </section>

</div>