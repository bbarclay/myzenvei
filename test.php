<?php
  setcookie("LoginName","FYICenter");
  setcookie("PreferredColor","Blue");
  print("<pre>\n");
  print("2 cookies were delivered.\n");

  if (isset($_COOKIE["LoginName"])) {
    $loginName = $_COOKIE["LoginName"];
    print("Received a cookie named as LoginName: ".$loginName."\n");
  } else {
    print("Did not received any cookie named as LoginName.\n");
  }
 
  $count = count($_COOKIE);
  print("$count cookies received.\n");
  foreach ($_COOKIE as $name => $value) {
     print "  $name = $value\n";
  }
  print("</pre>\n");
?>
