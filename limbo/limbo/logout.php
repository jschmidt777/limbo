<?php
session_start();
session_destroy();
header('Location: limbo.php');
exit();
