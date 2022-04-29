<?php


include "koneksi.php";

$id = $_POST['id'];

$conn->query("DELETE FROM tb_buku WHERE id =".$id);