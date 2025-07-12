<?php
session_start();

require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['csrf_token']) && verify_csrf_token($_POST['csrf_token'])) {
        echo "CSRF token is valid.";
    } else {
        echo "CSRF token is invalid.";
    }
}
?>