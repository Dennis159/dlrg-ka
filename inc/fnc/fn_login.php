<?php
  function DG_fnc_login($u, $p, $c = false){
    global $TOOL;
    $res = $TOOL->query("SELECT password, id FROM logindaten WHERE username = '$u'");

    if($res->rowCount() != 0){
      foreach ($res->fetchAll(PDO::FETCH_ASSOC) as $row);

      if(password_verify($p, $row['password'])){
        $_SESSION['valid_login'] = true;
        $_SESSION['uid']         = $row['id'];
        if($p == "Start123"){ $_SESSION['Start123'] = true; }
        if($c){
          setcookie("GD_SAPD_LOGIN", json_encode(array($u, $p)), time() + 3600 * 24 * 365);
        }
        return true;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }
