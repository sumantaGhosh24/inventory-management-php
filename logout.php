<?php
session_start();

unset($_SESSION["USER_ID"]);
unset($_SESSION["USER_ROLE"]);

header("Location: login.php");
?>