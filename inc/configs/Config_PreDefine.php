<?php
  function phpActionJSLog($text, $c = ""){
    switch($c){
      case "success": $color = "lightgreen"; break;
      case "warning": $color = "orange"; break;
      case "error":  $color = "red"; break;
      case "info":    $color = "cyan"; break;
      default: "white";
    }

    $text = date('H:i:s') . " | " . $_SERVER['HTTP_HOST'] . " | PHP-Code | $text";
    echo "<script>console.log('%c$text', 'color: $color;')</script>";
  }
?>
<script>
  function jsActionConsoleLog(text, c = "") {
    let color = "";

    switch (c) {
        case "success": color = "lightgreen"; break;
        case "warning": color = "orange"; break;
        case "error":   color = "red"; break;
        case "info":    color = "cyan"; break;
        default: color = "white";
    }

    const currentTime = new Date().toLocaleTimeString();
    const host = window.location.hostname;
    const logText = `${currentTime} | ${host} | JS-Code  | ${text}`;
    console.log(`%c${logText}`, `color: ${color};`);
  }
</script>