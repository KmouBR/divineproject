<?php
session_start();
session_unset();
session_destroy();
header("Location: /divineproject/index.php");
exit;
?>
