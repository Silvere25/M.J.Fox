<?php
session_start();
header('Location: ../' . $_SESSION['active_page']);
?>