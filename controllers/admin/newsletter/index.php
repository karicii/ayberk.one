<?php

authorize();

$db = App::resolve('database');

// İstatistikler
$stats = [
    'total' => $db->query('SELECT COUNT(*) as count FROM subscribers')->find()['count'],
    'active' => $db->query('SELECT COUNT(*) as count FROM subscribers WHERE status = "active"')->find()['count'],
    'unsubscribed' => $db->query('SELECT COUNT(*) as count FROM subscribers WHERE status = "unsubscribed"')->find()['count']
];

// Tüm aboneler (son eklenenler önce)
$subscribers = $db->query('SELECT * FROM subscribers ORDER BY subscribed_at DESC')->findAll();

$pageTitle = 'Bülten Aboneleri';

require BASE_PATH . '/templates/admin/newsletter/index.php';
