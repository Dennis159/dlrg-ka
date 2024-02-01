<?php
$id = $_GET['an'];
$row = $TOOL->query("SELECT * FROM lager_poolwaesche_basis WHERE artikel = $id")->fetch();

function GD_fnc_getPoolName($id){
  global $TOOL;
  $person = $TOOL->query("SELECT person FROM lager_poolwaesche_personen WHERE id = '$id'")->fetch()['person'];
  return GD_fnc_getUser($person)['vorname'] . " " . GD_fnc_getUser($person)['nachname'];
}

function GD_fnc_getPoolSince($id){
  global $TOOL;
  $res = $TOOL->query("SELECT seit FROM lager_poolwaesche_personen WHERE id = '$id'")->fetch()['seit'];
  return date('d.m.Y', strtotime($res));
}


?>
  <div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 style="display: flex; justify-content: center; align-items: center;" class="float-left">
              Artikel
            </h1>

          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Lager</li>
              <li class="breadcrumb-item">Artikel</li>
              <li class="breadcrumb-item active"><?php echo $row['name']?></li>
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
                <h3 class="profile-username text-center"><?php echo str_replace(" - ", "<br>- ", $row['name'])?></h3>
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Materialstelle Art. Nummer</b> <span class="float-right"><?php echo $row['artikel'] ?>
                                          <a href="https://shop.dlrg.de/redirect_switcher?sku=<?php echo $row['artikel'] ?>&type=product_autosuggest" target="_blank">
                                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                          </a>
                                         </span>
                  </li>
                  <li class="list-group-item">
                    Normalpreis <span class="float-right"><?php echo number_format($row['preis'], 2, ',', '.'); ?> €</span>
                    <br>Förderung <span class="float-right <?php echo $row['foerderung'] == 0 ? "text-danger" : "text-success"; ?>"><?php echo number_format($row['foerderung'], 2, ',', '.'); ?> €</span>
                    <br><b>Einkaufspreis <span class="float-right"><?php echo number_format($row['preis'] - $row['foerderung'], 2, ',', '.'); ?> €</b></span>
                  </li>
                  <li class="list-group-item">
                    <b>Existierenden Größen</b> <span class="float-right"><?php
                                                                            $g = str_replace("[\"", "", $row['groessen']);
                                                                            $g = str_replace("\"]", "", $g);
                                                                            $g = str_replace("\",\"", ", ", $g);
                                                                            echo GD_linebreak($g);
                                                                          ?></span>
                  </li>
                </ul>
                <a data-toggle="modal" data-target="#edit" class="btn btn-primary btn-block">Artikel bearbeiten</a>
                <br>
                <div class="text-center">
                  <img src="<?php echo $row['thumbnail']; ?>" height="250em" style="border-radius: 2em">
                </div>
              </div>

            </div>

          </div>

          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#overview" data-toggle="tab" id="uebersicht">Übersicht</a></li>
                  <li class="nav-item"><a class="nav-link" href="#lager" data-toggle="tab">im Lager</a></li>
                  <li class="nav-item"><a class="nav-link" href="#ausgabe" data-toggle="tab">ausgegeben</a></li>
                  <?php if(isset($_GET['id'])){?>
                    <li class="nav-item"><a class="nav-link" href="#<?php echo $_GET['id'] ?>" data-toggle="tab" id="details">
                      <i class="fa-solid fa-magnifying-glass-plus"></i> <?php echo $_GET['id'];?> <i class="fa-solid fa-magnifying-glass-plus"></i>
                    </a></li>
                  <?php } ?>
                  <?php $_GET['id'] = $_GET['id'] ?? "placeholderid"; ?>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content">

                  <div class="active tab-pane" id="overview">
                    <?php
                      include "modules/tab_overview.php";
                    ?>
                  </div>

                  <div class="tab-pane" id="lager">
                    <?php
                      include "modules/tab_lager.php";
                    ?>
                  </div>

                  <div class="tab-pane" id="ausgabe">
                    <?php
                      include "modules/tab_ausgabe.php";
                    ?>
                  </div>

                  <div class="tab-pane" id="<?php echo $_GET['id'];?>">
                    <?php
                    include "modules/tab_details.php";
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
<script>
    window.addEventListener("load", (event) => {
      const queryString = window.location.search;
      const urlParams = new URLSearchParams(queryString);
      const id = urlParams.get('id');

      if(id.startsWith("DLRKA")){
          document.getElementById('overview').classList.remove('active');
          document.getElementById(id).classList.add('active');

          document.getElementById('uebersicht').classList.remove('active');
          document.getElementById('details').classList.add('active');
      }
    });
</script>