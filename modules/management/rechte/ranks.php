<div class="content-wrapper">

  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Ränge / Departments</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item">Management</li>
            <li class="breadcrumb-item active">Ränge / Departments</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">

      <div class="card">
        <div class="card-header">
          <ul class="nav nav-pills">
            <?php
              $res = $TOOL->query("SELECT * FROM settings_departments")->fetchAll(PDO::FETCH_ASSOC);
              $c = 0;
              foreach($res as $dept){
                $dept = $dept['id'];
            ?>
            <li class="nav-item"><a class="nav-link <?php echo $c == 0 ? "active"  : ""; ?>" href="#tab<?php echo $dept ?>" data-toggle="tab"><?php echo GD_fnc_getDepartmentName($dept) ?></a></li>
            <?php $c++; } ?>
          </ul>
        </div>
        <div class="card-body">

          <div class="tab-content">

            <?php
              $c = 0;
              foreach($res as $dept){
                $dept = $dept['id'];
            ?>
              <div class="tab-pane <?php echo $c == 0 ? "active"  : ""; ?>" id="tab<?php echo $dept ?>">
                <table class="table table-striped table hover" id="table<?php echo $dept ?>">
                  <thead>
                  <tr>
                    <th>Rang</th>
                    <th>Name</th>
                    <th>Benutzergruppen</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  $res = $TOOL->query("SELECT * FROM settings_ranks WHERE department = $dept ORDER by id ASC")->fetchAll(PDO::FETCH_ASSOC);
                  foreach($res as $row){
                    ?>
                    <tr>
                      <td><?php echo $row['rank']; ?></td>
                      <td><?php echo $row['name']; ?></td>
                      <td><?php
                        $usergroups = json_decode($row['default_usergroups'], true);
                        $c = is_null($usergroups) ? 0 : count($usergroups);
                        if ($c == 0) {
                          echo "<i class='text-muted'>Keine Standard-Benutzergruppen zugewiesen</i>";
                        }
                        $i = 0;
                        foreach ($usergroups as $char) {
                          $i++;
                          if ($i < $c) {
                            echo GD_fnc_getUserGroup($char) . ", ";
                          }
                          if ($i == $c) {
                            echo GD_fnc_getUserGroup($char);
                          }
                        }
                        ?></td>
                      <td></td>
                    </tr>
                    <?php
                  }
                  ?>
                  </tbody>
                </table>
              </div>
            <?php
              echo "<script>let table = new DataTable('#table".$dept."', {});</script>";
             $c++; }
            ?>

          </div>

        </div>
      </div>

    </div>
  </section>

</div>

<div class="modal fade" id="new" style="padding-right: 17px;" aria-modal="true" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="post">
        <div class="modal-header">
          <h4 class="modal-title">Neue Benutzergruppe</h4>
        </div>
        <div class="modal-body">

          <div class="input-group">
            <input type="text" name="id" class="form-control" placeholder="ID"> &nbsp;&nbsp;

            <input type="text" name="name" class="form-control" placeholder="Name">
          </div>
          <br>
          <div class="input-group">
            <input type="text" name="desc" class="form-control" placeholder="Beschreibung">
          </div>
          <br>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-outline-success float-right" name="new">Benutzergruppe speichern</button>
        </div>
      </form>
    </div>
  </div>
</div>