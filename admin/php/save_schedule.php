<?php
require_once('koneksi.php');

if($_SERVER['REQUEST_METHOD'] != 'POST'){
    echo "<script> alert('Error: No data to save.'); location.replace('./') </script>";
    $koneksi->close();
    exit;
}

extract($_POST);
$allday = 0; // Default event bukan all-day

// Validasi input sederhana
if(empty($title) || empty($start_datetime) || empty($end_datetime)){
    echo "<script> alert('Semua field wajib diisi!'); location.replace('./') </script>";
    exit;
}

if(empty($id)){
    // Insert Baru
    $sql = "INSERT INTO `schedule_list` (`title`,`description`,`start_datetime`,`end_datetime`) VALUES ('$title','$description','$start_datetime','$end_datetime')";
}else{
    // Update Event yang ada
    $sql = "UPDATE `schedule_list` set `title` = '{$title}', `description` = '{$description}', `start_datetime` = '{$start_datetime}', `end_datetime` = '{$end_datetime}' where `id` = '{$id}'";
}

$save = $koneksi->query($sql);

if($save){
    echo "<script> alert('Jadwal Berhasil Disimpan.'); location.replace('../beranda.php') </script>"; // Ganti index.php sesuai nama file utamamu
}else{
    echo "<pre>";
    echo "An Error occured.<br>";
    echo "Error: ".$koneksi->error."<br>";
    echo "SQL: ".$sql."<br>";
    echo "</pre>";
}
$koneksi->close();
?>