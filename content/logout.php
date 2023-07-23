<?php

session_start();

session_destroy();

//header("Location: ../index.php");
echo "<script>window.location.href='../../index.php';</script>";
exit;