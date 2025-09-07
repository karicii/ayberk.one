<?php

function authorize() {
    if (!isset($_SESSION['user'])) {
        http_response_code(403);
        die('Bu sayfaya erişim yetkiniz yok.');
    }
}