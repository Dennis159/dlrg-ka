<table class="table table-striped table-hover">
  <thead>
  <tr>
    <th style="width: 9em!important;">#ID</th>
    <th style="width: 4em!important;">Größe</th>
    <th></th>
  </tr>
  </thead>
  <tbody>
  <?php
    $res = $TOOL->query("SELECT * FROM lager_poolwaesche_artikel WHERE artikel = $id AND lager = 1")->fetchAll(PDO::FETCH_ASSOC);
    foreach($res as $res){
      ?>
      <tr>
        <td style="width: 9em!important;"><?php echo $res['id']; ?></td>
        <td><?php echo $res['größe']; ?></td>
        <td>
          <a href="?artikel&an=<?php echo $_GET['an'] ?>&id=<?php echo $res['id'];?>" class="btn btn-outline-info"><i class="fa-solid fa-info-circle"></i></a>
        </td>
      </tr>
      <?php
    }
  ?>
  </tbody>
</table>