<?php

print_r($_SESSION);

if (!isset($_SESSION)) { session_start(); }

if (!isset($_SESSION['isAdmin'])) {
    header("HTTP/1.1 403 Forbidden");
    die();
}