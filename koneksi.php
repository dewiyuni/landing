<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_bakery");
if ($koneksi) {
} else {
    die("Masih error nih: " . mysqli_connect_error());
}
?>