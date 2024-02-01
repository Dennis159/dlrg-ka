<div class="content-wrapper">

  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Settings - Stringtable</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item">Settings</li>
            <li class="breadcrumb-item active">Stringtable</li>
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
              <input type="text" name="text" class="form-control" placeholder="Text">
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
              <th>Text</th>
              <th></th>
            </tr>
            </thead>
            <?php
              if(isset($_POST['save_new']) OR isset($_POST['edit'])){
                $str  = $_POST['STR'];
                $text = $_POST['text'];
                if(isset($_POST['save_new'])){
                  $TOOL->query("INSERT INTO settings_stringtable (STR, text) VALUES ('$str','$text')");
                }
                if(isset($_POST['edit'])){
                  $TOOL->query("UPDATE settings_stringtable SET text = '$text' WHERE STR = '$str'");
                }
              }

            $res = $TOOL->query("SELECT * FROM settings_stringtable")->fetchAll(PDO::FETCH_ASSOC);
            foreach($res as $row){
              ?>
              <tr>
                <td style="width: 16em!important;"><?php echo $row['STR'] ?></td>
                <td><?php echo $row['text'] ?></td>
                <td><button class="btn btn-outline-success" data-toggle="modal" data-target="#<?php echo $row['STR']; ?>"><i class="fa-solid fa-pen"></i> Bearbeiten</button></td>
              </tr>

              <div class="modal fade" id="<?php echo $row['STR']; ?>" style="padding-right: 17px;" aria-modal="true" role="dialog">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <form method="post">
                      <div class="modal-header">
                        <h4 class="modal-title">String bearbeiten</h4>
                      </div>
                      <div class="modal-body">

                        <div class="input-group">
                          <input type="text" name="STR" class="form-control" placeholder="STR-Key" value="<?php echo $row['STR']; ?>" readonly> &nbsp;&nbsp;

                          <input type="text" name="text" class="form-control" placeholder="Text" value="<?php echo $row['text']; ?>">
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