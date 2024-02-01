<?php
  function GD_fnc_needle(): array|string
  {
    $needel = explode("&", $_SERVER['REQUEST_URI']);
    return str_replace("/?", "", $needel[0]);
  }

  function GD_fnc_activeDropdown($i): void
  {
    echo in_array(GD_fnc_needle(), $i) ? " menu-is-opening menu-open" : "";
  }

  function GD_fnc_activeItem($i, $d = false): void
  {
    $d = $d ? "active" : "bg-active";
    if(is_array($i)){
      echo in_array(GD_fnc_needle(), $i) ? $d : "";
    } else {
      echo GD_fnc_needle() == $i ? $d : "";
    }
  }

  function GD_fnc_checkAccess($u = array()): bool
  {
    global $TOOL;
    $u[] = "admin";
    foreach($u as $u){
      $res = $TOOL->query("SELECT members FROM usergroups WHERE id = '$u'")->fetch();
      if(in_array($_SESSION['uid'], json_decode($res['members'], true))) {
        return true;
      }
    }
    return false;
  }

  function GD_fnc_logIt($u, $t, $s): void
  {
    global $TOOL;
    $TOOL->query("INSERT INTO logs_global (text, user, severity, created_at) VALUES ('$t', '$u', '$s', NOW())");
  }

  function GD_fnc_getAge($geburtsdatum): int|string
  {
    $geburtsTimestamp = strtotime($geburtsdatum);
    $aktuellesDatum = time();
    $alter = date("Y", $aktuellesDatum) - date("Y", $geburtsTimestamp);
    if (date("md", $aktuellesDatum) < date("md", $geburtsTimestamp)) {
      $alter--;
    }
    return $alter;
  }

  function GD_fnc_reload(): void
  {
    echo "<script>window.location.href = window.location.href;</script>";
  }

  function GD_fnc_usergroupByRank($r, $d, $u): void
  {
    global $TOOL;
    $default = $TOOL->query("SELECT * FROM settings_ranks WHERE department = $d AND `rank` = $r")->fetch()['default_usergroups'];
    $default = json_decode($default, true);
    $allGroups = $TOOL->query("SELECT * FROM usergroups")->fetchAll(PDO::FETCH_ASSOC);
    foreach($allGroups as $all){
      $members = $TOOL->query("SELECT * FROM usergroups WHERE id = '".$all['id']."'")->fetch()['members'];
      $members = json_decode($members, true);
      if(!in_array($u, $members) AND in_array($all['id'], $default)){
        $members[] = intval($u);
      }
      if(in_array($u, $members) AND !in_array($all['id'], $default)){
        $key = array_search($u, $members);
        if ($key !== false) { unset($members[$key]); }
      }
      $members = json_encode($members);
      $TOOL->query("UPDATE usergroups SET members = '$members' WHERE id = '".$all['id']."'");
    }
  }

  function GD_getATN($a, $id): string
  {
    global $TOOL;
    $atn = $TOOL->query("SELECT * FROM employee_ausbildugnen WHERE id = $id")->fetch();
    $atn = $atn[$a];
    if($atn == 0){ return "<span class='text-danger'>ATN nicht vorhanden</span>"; }
    if($atn == 1){ return "<span class='text-warning'>zum Lehrgang angemeldet / laufender Lehrgang</span>"; }
    if($atn == 2){ return "<span class='text-success'>ATN vorhanden (nicht im ISC eingetragen)</span>"; }
    if($atn == 3){ return "<span class='text-success'>ATN vorhanden</span>"; }
    return "fehler";
  }

  function GD_getATNFiles($atn, $id): void
  {
    global $TOOL;
    $a = $TOOL->query("SELECT * FROM employee_ausbildugnen WHERE id = $id")->fetch();
    $a = $a[$atn];
    $verzeichnis = $_SERVER['DOCUMENT_ROOT'] .  "/atns/$id/";
    $dateiMuster = "$atn.*"; // Hier verwenden wir * als Platzhalter für die Dateierweiterung

    $gefundeneDateien = glob($verzeichnis . $dateiMuster);
    if(!empty($gefundeneDateien)){
      $ext = explode(".", $gefundeneDateien[0]);
      $ext = end($ext);
      if($ext == "pdf"){
        echo '<a href="https://dlrg-ka.de/atns/'.$id.'/'.$atn.'.'.$ext.'" target="_blank"><i class="fa-solid fa-file-pdf"></i></a>';
      } else {
        echo '<a href="https://dlrg-ka.de/atns/'.$id.'/'.$atn.'.'.$ext.'" target="_blank"><i class="fa-solid fa-file-image"></i></a>';
      }
    } else if($a >= 2){
      echo '<i class="fa-solid fa-x text-danger"></i>';
    }
  }

  function GD_fnc_atnFileExists($atn): bool
  {
    $id = $_SESSION['uid'];
    $verzeichnis = $_SERVER['DOCUMENT_ROOT'] .  "/atns/$id/";
    $dateiMuster = "$atn.*";
    $gefundeneDateien = glob($verzeichnis . $dateiMuster);
    return !empty($gefundeneDateien);
  }

  function GD_getATNNumeric($a, $id){
    global $TOOL;
    $atn = $TOOL->query("SELECT * FROM employee_ausbildugnen WHERE id = $id")->fetch();
    return $atn[$a];
  }

function GD_linebreak($inputString): string
{
  $parts = explode(',', $inputString);
  $result = '';
  $count = count($parts);

  for ($i = 0; $i < $count; $i++) {
    $result .= $parts[$i];

    if (($i + 1) % 6 == 0 && $i < $count - 1) {
      $result .= ',<br>';
    } else if ($i < $count - 1) {
      $result .= ',';
    }
  }

  return $result;
}
function GD_fnc_getYearMonthDaysFromXToToday($date): string
{
  $datetime_1 = $date;
  $datetime_2 = date('d.m.Y');

  $start_datetime = new DateTime($datetime_1);
  $diff = $start_datetime->diff(new DateTime($datetime_2));

  return convertDays($diff->days);
}

function GD_fnc_getPoolTimeInRotation($id): string
{
    global $TOOL;
    $days = 0;

    $personen = $TOOL->query("SELECT * FROM lager_poolwaesche_personen WHERE id = '$id'")->fetchAll(PDO::FETCH_ASSOC);

    foreach ($personen as $person) {
      $datetime_1 = $person['seit'];
      $datetime_2 = $person['bis'] != null ? $person['bis'] : date('Y-m-d');

      $start_datetime = new DateTime($datetime_1);
      $diff = $start_datetime->diff(new DateTime($datetime_2));
      $days = $days + $diff->days;
    }
    return convertDays($days);
}

function convertDays($days): string
{
  $years = floor($days / 365);
  $months = floor(($days % 365) / 30);
  $remainingDays = $days % 30;

  $result = '';

  if ($years > 0) {
    $result .= $years . ' Jahr' . ($years > 1 ? 'e' : '') . ', ';
  }

  if ($months > 0) {
    $result .= $months . ' Monat' . ($months > 1 ? 'e' : '') . ', ';
  }

  if ($remainingDays > 0) {
    if ($result !== '') {
      $result = rtrim($result, ', ') . ' und ';
    }
    $result .= $remainingDays . ' Tag' . ($remainingDays > 1 ? 'e' : '');
  }

  return $result;
}