<?php
  include $_SERVER['DOCUMENT_ROOT'] . "/inc/Config_Master.php";
?>
<select name="rank" class="form-control">
  <?php
  $department = $_GET['d'];
  $r = $_GET['r'];
  $rank = $TOOL->query("SELECT * FROM settings_ranks WHERE department = $department")->fetchAll(PDO::FETCH_ASSOC);
  foreach ($rank as $rank){
    ?>
    <option value="<?php echo $rank['id'] ?>" <?php echo $rank['rank'] == $r ? "selected" : ""; ?>><?php echo $rank['name'] ?></option>
    <?php
  }
  ?>
</select>