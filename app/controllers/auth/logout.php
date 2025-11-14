<?php
session_start();
session_unset();
session_destroy();

header('Location: ../../../public/index.php?status=logout_success');
exit;