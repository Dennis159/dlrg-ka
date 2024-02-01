<div class="content-wrapper">

  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Settings - Linktable</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item">Settings</li>
            <li class="breadcrumb-item active">Linktable</li>
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
              <input type="text" name="STR" class="form-control" placeholder="STR-Key">
            </div>
            <div class="input-group col-3">
              <input type="text" name="LINK" class="form-control" placeholder="Link">
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
              <th style="width: 12em!important;">STR-Key</th>
              <th>LINK</th>
              <th></th>
            </tr>
            </thead>
            <?php
              if(isset($_POST['save_new']) OR isset($_POST['edit'])){
                $str  = $_POST['STR'];
                $LINK = $_POST['LINK'];
                if(isset($_POST['save_new'])){
                  $TOOL->query("INSERT INTO settings_linktable (STR, LINK) VALUES ('$str','$LINK')");
                  $t = 'Hat einen Link mit dem key \"' . $str . '\" erstellt';
                  GD_fnc_logIt($_SESSION['uid'], $t, 1);
                }
                if(isset($_POST['edit'])){
                  $TOOL->query("UPDATE settings_linktable SET LINK = '$LINK' WHERE STR = '$str'");
                  $t = 'Hat den Link mit dem key \"' . $str . '\" bearbeitet';
                  GD_fnc_logIt($_SESSION['uid'], $t, 1);
                }
              }

            $res = $TOOL->query("SELECT * FROM settings_linktable")->fetchAll(PDO::FETCH_ASSOC);
            foreach($res as $row){
              ?>
              <tr>
                <td style="width: 16em!important;"><?php echo $row['STR'] ?></td>
                <td><?php echo $row['LINK'] ?></td>
                <td><button class="btn btn-outline-success" data-toggle="modal" data-target="#<?php echo $row['STR']; ?>"><i class="fa-solid fa-pen"></i> Bearbeiten</button></td>
              </tr>

              <div class="modal fade" id="<?php echo $row['STR']; ?>" style="padding-right: 17px;" aria-modal="true" role="dialog">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <form method="post">
                      <div class="modal-header">
                        <h4 class="modal-title">Link bearbeiten</h4>
                      </div>
                      <div class="modal-body">

                        <div class="input-group">
                          <input type="text" name="STR" class="form-control" placeholder="STR-Key" value="<?php echo $row['STR']; ?>" readonly> &nbsp;&nbsp;

                          <input type="text" name="LINK" class="form-control" placeholder="Link" value="<?php echo $row['LINK']; ?>">
                        </div>
                        <br>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-success float-right" name="edit">String speichern</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

              <?php
            }
            ?>
          </table>
        </div>
      </div>


    </div>
  </section>

</div>