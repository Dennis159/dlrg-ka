<?php
$dsn      = 'mysql: host=45.83.245.57;dbname=dledevd1_';
$user     = 'dlrgka';
$password = 'CHX41Europa#1';

try {
  $TOOL = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
  echo "<h3 style='text-align: center!important; color: darkred; background: darkgoldenrod; padding: 1em!important; border-radius: 1em!important;'>
  <b>Datenbank-Fehler:</b><br><small>".$e->getMessage()."</small>
</h3>";
}

  $s  = $_GET['d'];
  $id = $_GET['uid'];
  $status = $TOOL->query("SELECT * FROM employee_ausbildugnen WHERE id = $id")->fetch();
  $s = $status[$s];

?>
  <br>
  <div>

    <div class="icheck-danger">
      <input type="radio" name="status" value="0" id="s0" <?php if($s == 0){ echo "checked"; } ?>>
      <label for="s0">ATN nicht vorhanden</label>
    </div>

    <div class="icheck-warning">
      <input type="radio" name="status" value="1" id="s1" <?php if($s == 1){ echo "checked"; } ?>>
      <label for="s1">Zum Lehrgang angemeldet / Laufender Lehrgang</label>
    </div>

    <div class="icheck-success">
      <input type="radio" name="status" value="2" id="s2" <?php if($s == 2){ echo "checked"; } ?>>
      <label for="s2">ATN vorhanden (nicht im ISC eingetragen)</label>
    </div>

    <div class="icheck-success">
      <input type="radio" name="status" value="3" id="s3" <?php if($s == 3){ echo "checked"; } ?>>
      <label for="s3">ATN vorhanden</label>
    </div>

  </div>
