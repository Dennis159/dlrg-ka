<div class="content-wrapper">

  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Mitgliederverzeichnis</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item">Management</li>
            <li class="breadcrumb-item active">Mitgliederverzeichnis</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">

      <div class="card">
        <?php
          if(GD_fnc_checkAccess(array("kasse"))){
        ?>
          <div class="card-header">
            <button class="btn btn-outline-info" data-toggle="modal" data-target="#new"><i class="fa-solid fa-plus"></i> Neue Akte</button>
          </div>
        <?php
          }
        ?>
        <div class="card-body">
          <table class="table table-striped table hover" id="employees">
            <thead>
              <tr>
                <th>Name</th>
                <th>Funktion</th>
                <th>E-Mail</th>
                <th>Telefon</th>
                <th>Ressort</th>
                <th>Dienststunden gesamt</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            <?php
              if(isset($_POST['new'])){
                $vorname  = $_POST['vorname'];
                $nachname = $_POST['nachname'];
                $email  = $_POST['email'];
                $phone    = $_POST['phone'];
                $bday     = $_POST['bday'];
                  $TOOL->query("INSERT INTO logindaten (created_at) VALUES (NOW())");
                  $id = $TOOL->lastInsertId();
                  $TOOL->query("INSERT INTO employee_files (id, vorname, nachname, phone, email, bday, `rank`, department, status, urlaub)
                                                          VALUES ($id, '$vorname', '$nachname', '$phone', '$email', '$bday', 0, 1, 0, 0) ");
                  $TOOL->query("INSERT INTO employee_ausbildugnen (id) VALUES ($id)");

                $t = 'Hat den Mitarbeiter <a href="?employee-file&id='.$id.'">'.$vorname.' '.$nachname.'</a> mit der ID '.$id.' erstellt';
                GD_fnc_logIt($_SESSION['uid'], $t, 1);
                echo "<script>window.location.href = '?employee-file&id=$id&new'</script>";
              }
              $res = $TOOL->query("SELECT * FROM employee_files WHERE status != 1 ORDER by nachname ASC")->fetchAll(PDO::FETCH_ASSOC);
              foreach($res as $row){
            ?>
              <tr>
                <td><?php echo $row['nachname'] . ", " . $row['vorname']; ?></td>
                <td><?php echo GD_fnc_getRankName($row['rank'], $row['department']); ?></td>
                <td><a href="mailto:<?php echo $row['email'] ?>"><?php echo $row['email'] ?></a> <?php echo $row['email'] == "" ? "<i class='text-muted'>Keine E-Mail Adresse hinterlegt</i>" : ""; ?></td>
                <td><a href="tel:<?php echo $row['phone'] ?>"><?php echo $row['phone'] ?></a> <?php echo $row['phone'] == "" ? "<i class='text-muted'>Keine Telefonnummer hinterlegt</i>" : ""; ?></td>
                <td><?php echo GD_fnc_getDepartmentName($row['department']); ?></td>
                <td>550 Stunden</td>
                <td>
                  <?php if(GD_fnc_checkAccess(array("admin")) OR GD_fnc_checkAccess(array("kasse"))){ ?>
                    <a href="?employee-file&id=<?php echo $row['id']; ?>" class="btn btn-outline-info"><i class="fa-solid fa-folder-open"></i></a>
                  <?php } ?>
                </td>
              </tr>
            <?php
              }
            ?>
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </section>

</div>

<div class="modal fade" id="new" style="padding-right: 17px;" aria-modal="true" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post">
        <div class="modal-header">
          <h4 class="modal-title">Neue Mitarbeiter-Akte</h4>
        </div>
        <div class="modal-body">

          <div class="input-group">
            <input type="text" name="vorname" class="form-control" placeholder="Vorname"> &nbsp;&nbsp;

            <input type="text" name="nachname" class="form-control" placeholder="Nachname">
          </div>
          <br>
          <div class="input-group">
            <input type="text" name="email" class="form-control" placeholder="E-Mail"> &nbsp;&nbsp;

            <input type="text" name="phone" class="form-control" placeholder="Telefonnummer">
          </div>
          <br>
          <div class="input-group">
            <div class="input-group-prepend" data-toggle="tooltip" data-placement="bottom" title="Geburstag">
              <span class="input-group-text"><i class="fa-solid fa-cake-candles"></i></span>
            </div>
            <input type="date" name="bday" class="form-control" placeholder="Geburstag" max="<?php echo date('Y-m-d', strtotime('-18 years'));?>">
            &nbsp;&nbsp;
            <input type="" readonly class="form-control">

          </div>
          <br>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-outline-success float-right" name="new">Akte Anlegen</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
    let table = new DataTable('#employees', {});
</script>