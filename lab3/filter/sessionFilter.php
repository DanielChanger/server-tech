<?php

if (empty($_SESSION)) {
    header("HTTP/1.1 403 Forbidden");
    die();
}