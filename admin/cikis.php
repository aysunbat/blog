<?php
session_start();
session_destroy();
unset($_SESSION['giris']);
unset($_SESSION['nick']);
header('LOCATION:../');