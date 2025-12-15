<?php
$host     = 'localhost';
$user     = 'root';
$password = '';
$db       = 'dummy_db';

$koneksi = mysqli_connect($host, $user, $password, $db);

if(!$koneksi){
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>