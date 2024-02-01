<?php
  function stringtable($str){
    global $TOOL;
    return $TOOL->query("SELECT * FROM settings_stringtable WHERE STR = '$str'")->fetch()['text'];
  }

  function linktable($str){
    global $TOOL;
    return $TOOL->query("SELECT * FROM settings_linktable WHERE STR = '$str'")->fetch()['LINK'];
  }

  function GD_fnc_checkSetting($id){
    global $TOOL;
    return $TOOL->query("SELECT * FROM settings_options WHERE id = '$id'")->fetch()['status'] == "true";
  }