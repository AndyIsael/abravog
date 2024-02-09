<?php
session_start();
session_destroy();
header('Location: /abravog/index.php');