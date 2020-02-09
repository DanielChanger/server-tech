<?php

print_r($_SESSION);

if (isset($_SESSION)) {
    header("HTTP/1.1 403 Forbidden");
    die();
}