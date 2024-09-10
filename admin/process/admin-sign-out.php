<?php
session_start();
session_unset();
session_destroy();

header("Location: ../login.php");  // Redirecting To Home Page