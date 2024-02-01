<?php
  function GD_fnc_getRankName($r, $d){
    global $TOOL;
    $res = $TOOL->query("SELECT name FROM settings_ranks WHERE rank = $r AND department = $d")->fetch()['name'];
    return $res != null ? $res : '<small class="text-warning">Rang <b>'.$r.'</b> existiert in diesem Ressort nicht</small>';
  }

function GD_fnc_getDepartmentName($d){
  global $TOOL;
  $res = $TOOL->query("SELECT name FROM settings_departments WHERE id = $d")->fetch()['name'];
  return $res != null ? $res : '<small class="text-warning">Dieses Ressort ('.$d.') existiert nicht!</small>';
}

function GD_fnc_getUserGroup($u){
  global $TOOL;
  $res = $TOOL->query("SELECT name FROM usergroups WHERE id = '$u'")->fetch()['name'];
  return $res != null ? $res : '';
}

function GD_fnc_getUser($u){
  global $TOOL;
  $res = $TOOL->query("SELECT * FROM employee_files WHERE id = $u")->fetch();
  return $res != null ? $res : '<small class="text-warning">Dieser Nutzer ('.$u.') existiert nicht!</small>';
}
  
function GD_fnc_getStatus($s){
  switch ($s){
    case 0: return '<span class="badge badge-secondary font-weight-normal text-md">Bewerber</span>'; break;
    case 1: return '<span class="badge badge-danger font-weight-normal text-md">Ehemaliger Mitarbeiter</span>'; break;
    case 2: return '<span class="badge badge-danger font-weight-normal text-md">Suspendiert</span>'; break;;
    case 3: return '<span class="badge badge-success font-weight-normal text-md">Aktiv</span>'; break;;
    case 4: return '<span class="badge badge-warning font-weight-normal text-md">wenig Aktiv</span>'; break;
    case 5: return '<span class="badge badge-danger font-weight-normal text-md">Inaktiv</span>'; break;
    case 6: return '<span class="badge badge-primary font-weight-normal text-md">Urlaub (RP)</span>'; break;
    case 7: return '<span class="badge badge-primary font-weight-normal text-md">Urlaub (RL)</span>'; break;
  }
}