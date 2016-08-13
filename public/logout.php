<?php

/* 
 * Licensed to Bill Radja Pono <baingao@gmail.com>
 * Unauthorized use is prohibited
 */
session_start();
session_unset();
session_destroy();
header('location: index.php');
