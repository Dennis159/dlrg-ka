<table class="table table-striped table-hover">
  <thead>
  <tr>
    <th style="width: 9em!important;">#ID</th>
    <th style="width: 4em!important;">Größe</th>
    <th style="width: 15em!important;">Mitglied</th>
    <th style="width: 8em!important;">Seit</th>
    <th></th>
  </tr>
  </thead>
  <tbody>
  <?php
  $res = $TOOL->query("SELECT * FROM lager_poolwaesche_artikel WHERE artikel = $id AND lager = 0")->fetchAll(PDO::FETCH_ASSOC);
  foreach($res as $res){
    ?>
    <tr>
      <td style="width: 9em!important;"><?php echo $res['id']; ?></td>
      <td style="width: 4em!important;" class="text-center"><?php echo $res['größe']; ?></td>
      <td style="width: 15em!important;"><?php echo GD_fnc_getPoolName($res['id']); ?></td>
      <td><?php echo GD_fnc_getPoolSince($res['id']); ?></td>
      <td>
        <a href="?artikel&an=<?php echo $_GET['an'] ?>&id=<?php echo $res['id'];?>" class="btn btn-outline-info"><i class="fa-solid fa-info-circle"></i></a>
      </td>
    </tr>
    <?php
  }
  ?>
  </tbody>
</table>