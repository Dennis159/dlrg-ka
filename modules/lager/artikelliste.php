<div class="content-wrapper">

  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Artikel Liste</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item">Lager</li>
            <li class="breadcrumb-item active">Artikel Liste</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <?php
    if(isset($_POST['save'])){
      $name      = $_POST['name'];
      $artikel   = $_POST['artikel'];
      $preis     = $_POST['preis'];
      $thumbnail = $_POST['thumbnail'];
      $groessen  = str_replace(" ", "", $_POST['groeßen']);
      $groessen  = json_encode(explode(",", $groessen));

      $TOOL->query("INSERT INTO lager_poolwaesche_basis (artikel, preis, name, thumbnail, groessen) VALUES ($artikel, $preis, '$name', '$thumbnail', '$groessen')");
    }
  ?>

  <section class="content">
    <div class="container-fluid">

      <div class="card">
        <div class="card-header">
          <button data-toggle="modal" data-target="#newArticle" class="btn btn-outline-primary">neuer Poolwäscheartikel</button>
        </div>
        <div class="card-body">

          <div class="row justify-content-center row-eq-height">
            <?php
              $artikels = $TOOL->query("SELECT * FROM lager_poolwaesche_basis")->fetchAll(PDO::FETCH_ASSOC);
              foreach($artikels as $artikel){
            ?>
              <div class="col-12 col-md-3 mb-3">
                <div class="card">
                  <div class="card-header">
                    <?php echo $artikel['name'] ?>
                  </div>
                  <div class="card-body text-center">
                    <img src="<?php echo $artikel['thumbnail']; ?>" height="150em" style="border-radius: 2em">
                  </div>
                  <div class="card-footer justfy-content-between">
                    <a href="https://shop.dlrg.de/redirect_switcher?sku=<?php echo $artikel['artikel'] ?>&type=product_autosuggest" target="_blank" class="btn btn-outline-info"><i class="fa-solid fa-shop"></i> Materialstelle</a>
                    <a href="?artikel&an=<?php echo $artikel['artikel']; ?>" class="btn btn-outline-info float-right"><i class="fa-solid fa-info-circle"></i> Detailsseite</a>
                  </div>
                </div>
              </div>
            <?php
              }
            ?>
          </div>

        </div>
      </div>

    </div>
  </section>

</div>

<div class="modal fade" id="newArticle" style="padding-right: 17px;" aria-modal="true" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post">
        <div class="modal-header">
          <h4 class="modal-title">Neuer Poolwäsche-Artikel</h4>
        </div>
        <div class="modal-body">

          <div class="input-group">
            <input type="text" name="name" class="form-control" placeholder="Bezeichnung der Kleidung">
          </div>
          <br>
          <div class="input-group">
            <input type="number" name="artikel" class="form-control" placeholder="Artikelnummer"> &nbsp;&nbsp;
            <input type="number" name="preis" class="form-control" placeholder="Preis" step="any">
          </div>
          <br>

          <div class="input-group">
            <input type="url" name="thumbnail" class="form-control" placeholder="Thumbnail">
          </div>
          <br>

          <div class="input-group">
            <textarea name="groeßen" rows="2" class="form-control" placeholder="Verfügbare größen OHNE leerzeichen durch , getrennt"></textarea>
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-outline-success float-right" name="save">Neues Passwort speichern</button>
        </div>
      </form>
    </div>
  </div>
</div>