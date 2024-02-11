<?php
session_start();
session_unset();
session_destroy();
echo "Logout Succussful";
header("Location: Registration.html");
exit();
?>
