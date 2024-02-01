<?php
  $id = $_GET['id'];
  $row = $TOOL->query("SELECT * FROM employee_files WHERE id = $id")->fetch();
?>
<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 style="display: flex; justify-content: center; align-items: center;" class="float-left">
            Mitglieder Akte &nbsp;
            <?php echo GD_fnc_getStatus($row['status']); ?> &nbsp;
            <?php echo $row['rank'] >= 3 ? "<span class='badge badge-primary font-weight-normal text-md'>Ressortleitung</span>" : "";  ?>
          </h1>

        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item">Management</li>
            <li class="breadcrumb-item">Mitglieder Akte</li>
            <li class="breadcrumb-item active"><?php echo $row['vorname'] . " " . $row['nachname'] ?></li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">

          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <h3 class="profile-username text-center"><?php echo $row['vorname'] . " " . $row['nachname'] ?></h3>
              <p class="text-muted text-center"><?php echo GD_fnc_getRankName($row['rank'], $row['department']) ?></p>
              <ul class="list-group list-group-unbordered mb-3">
                <?php if(GD_fnc_checkSetting("departments")){ ?>
                <li class="list-group-item">
                  <b>Ressort</b> <span class="float-right"><?php echo GD_fnc_getDepartmentName($row['department']) ?></span>
                </li>
                <?php } ?>
                <li class="list-group-item">
                  <b>E-Mail</b> <span class="float-right"><?php echo $row['email'] != null ? "<a href='mailto:".$row['email']."'>" . $row['email'] . "</a>" : "<i class='text-muted'>nicht hinterlegt</i>"; ?></span>
                </li>
                <li class="list-group-item">
                  <b>Telefonnummer</b> <span class="float-right"><?php echo $row['phone'] != null ? $row['phone'] : "<i class='text-muted'>nicht hinterlegt</i>"; ?></span>
                </li>
                <li class="list-group-item">
                  <b>Geburtstag</b> <span class="float-right"><?php echo $row['bday'] != null ? date('d.m.Y', strtotime($row['bday'])) . " (".GD_fnc_getAge($row['bday']).")" : "<i class='text-muted'>nicht hinterlegt</i>"; ?></span>
                </li>
              </ul>
                <a data-toggle="modal" data-target="#daten"           class="btn btn-primary btn-block">Persönliche Daten</a>
                <a data-toggle="modal" data-target="#rangstatus"      class="btn btn-primary btn-block">Rang / Aktivitätsstatus</a>
                <a data-toggle="modal" data-target="#benutzergruppen" class="btn btn-primary btn-block">Benutzergruppen</a>
            </div>

          </div>

        </div>

        <div class="col-md-9">
          <div class="card">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#notepad" data-toggle="tab">Notizen</a></li>
              </ul>
            </div>
            <div class="card-body">
              <div class="tab-pane">

                <div class="tab-content" id="notepad">
                  <?php
                   // include "modules/tab_notes.php";
                  ?>
                </div>

                <div class="tab-content active" id="notepad">
                  <?php
                   include "modules/tab_atns.php";
                  ?>
                </div>

              </div>
            </div>
          </div>

        </div>

      </div>

    </div>
  </section>

</div>

<?php
  include "modules/modal_daten.php";
  include "modules/modal_rankstatus.php";
  include "modules/modal_usergroups.php";
?>