<?php
$dsn      = 'mysql: host=45.83.245.57;dbname=dledevd1_';
$user     = 'dlrgka';
$password = 'CHX41Europa#1';

try {
  $TOOL = new PDO($dsn, $user, $password);
  phpActionJSLog("Datenbankverbindung erfolgreich (TOOL-Datenbank)!", "success");
} catch (PDOException $e) {
  echo "<h3 style='text-align: center!important; color: darkred; background: darkgoldenrod; padding: 1em!important; border-radius: 1em!important;'>
  <b>Datenbank-Fehler:</b><br><small>".$e->getMessage()."</small>
</h3>";
}