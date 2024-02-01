<div class="content-wrapper">

  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Benutzergruppen</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item">Management</li>
            <li class="breadcrumb-item active">Benutzergruppen</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">

      <div class="card">
        <div class="card-header">
          <button class="btn btn-outline-primary" data-toggle="modal" data-target="#new">Neue Benutzergruppe</button>
        </div>
        <div class="card-body">

          <table class="table table-striped table hover">
            <thead>
            <tr>
              <th>Benutzergruppe</th>
              <th>Name</th>
              <th>Beschreibung</th>
              <th>Mitglieder</th>
              <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $res = $TOOL->query("SELECT * FROM usergroups ORDER by id ASC")->fetchAll(PDO::FETCH_ASSOC);
            foreach($res as $row){
              ?>
              <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td><?php echo count(json_decode($row['members'], true)); ?></td>
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