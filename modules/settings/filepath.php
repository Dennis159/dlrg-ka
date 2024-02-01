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
          <h1 class="m-0">Settings - Filepath</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item">Settings</li>
            <li class="breadcrumb-item active">Filepath</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">

      <div class="card">
        <div class="card-header">
          <form method="post" class="row">
            <div class="input-group col-2">
              <input type="text" name="urlkey" class="form-control" placeholder="URL-Key">
            </div>
            <div class="input-group col-3">
              <input type="text" name="path" class="form-control" placeholder="Dateipfad">
            </div>
            <div class="input-group col-3">
              <input type="text" name="description" class="form-control" placeholder="Beschreibung">
            </div>
            <div class="input-group col-3">
              <button type="submit" name="save_new" class="btn btn-outline-success"><i class="fa-solid fa-plus"></i></button>
            </div>
          </form>
        </div>
        <div class="card-body">
          <table class="table table-striped table hover">
            <thead>
              <tr>
                <th style="width: 12em!important;">URL-Key</th>
                <th>Dateipfad</th>
                <th>Beschreibung</th>
              </tr>
            </thead>
            <?php
              $res = $TOOL->query("SELECT * FROM settings_filepaths")->fetchAll(PDO::FETCH_ASSOC);
              foreach($res as $row){
            ?>
              <tr>
                <td style="width: 12em!important;"><span class="text-muted">?</span><?php echo $row['urlkey'] ?></td>
                <td><?php echo $row['path'] ?></td>
                <td><?php echo $row['description'] ?></td>
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