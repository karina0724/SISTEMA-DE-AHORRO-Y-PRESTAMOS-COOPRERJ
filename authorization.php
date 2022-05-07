<?php

session_start();
  if(!isset($_SESSION['login_id']) && ($_GET["page"] != "login"))
    header('location:login.php');
