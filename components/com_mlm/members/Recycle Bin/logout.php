<?php
session_start();
session_destroy();
header('Location: index.php?option=com_mlm&page=main');
?>