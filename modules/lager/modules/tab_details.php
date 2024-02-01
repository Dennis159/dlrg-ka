<h5 class="font-weight-bolder">Detailansicht zu <span class="font-weight-light"><?php echo $_GET['id'];?></span></h5>
<a href="?artikel&an=<?php echo $_GET['an'] ?>" class="float-right" style="margin-top: -2em!important;" data-toggle="tooltip" data-placement="left" title="Detailansicht schließen">
  <i class="fa-solid fa-x text-danger"></i>
</a>

<style>
  td {
    padding-left: 1em!important;
  }
</style>

<?php
  $detail = $TOOL->query("SELECT * FROM lager_poolwaesche_artikel WHERE id = '" . $_GET['id'] . "'")->fetch();
  $person = $TOOL->query("SELECT * FROM lager_poolwaesche_personen WHERE id = '" . $_GET['id'] . "'")->fetch();
?>

<table>
  <tr>
    <th>Status</th>
    <td><?php echo $detail['lager'] == 1 ? "<span class='badge badge-success'>im Lager</span>" : "<span class='badge badge-warning'>ausgegeben</span>"?></td>
    <td class="text-sm">&nbsp;(seit <?php echo date('d.m.Y', strtotime($person['seit'])); ?>)</td>
  </tr>
  <?php if($detail['lager'] == 0){ ?>
  <tr>
    <th>Mitglied</th>
    <td><?php echo GD_fnc_getPoolName($detail['id']) ?></td>
  </tr>
  <?php } ?>
  <tr>
    <th>Zeit seit Kauf</th>
    <td><?php echo GD_fnc_getYearMonthDaysFromXToToday($detail['kaufdatum']) ?></td>
    <td class="text-sm">&nbsp;(<?php echo date('d.m.Y', strtotime($detail['kaufdatum'])); ?>)</td>
  </tr>
  <tr>
    <th>Zeit im Umlauf</th>
    <td><?php echo GD_fnc_getPoolTimeInRotation($detail['id']) ?></td>
    <td><i class="fa-solid fa-info-circle text-info" data-toggle="tooltip" data-placement="right" title="Zeit welche das Kleidungsstück in 'obhut' eines Mitgliedes also nicht im Lager war"></i></td>
  </tr>
</table>