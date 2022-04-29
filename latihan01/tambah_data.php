<?php
include 'koneksi.php';

$judulBuku = $_POST['judul'];
$pengarang = $_POST['pengarang'];
$penerbit = $_POST['penerbit'];

$result['pesan'] = "";

if($judulBuku == ""){
    $result['pesan'] = 'judul buku harus di isi';
}else if($pengarang == ""){
    $result['pesan'] = 'pengarang harus di isi';
}else if($penerbit ==""){
    $result['pesan'] = 'penerbit tidak bole kosong';
}else{
    $queryResult = $conn->query("INSERT INTO tb_buku(judul_buku,pengarang,penerbit)
    VALUES('". $judulBuku ."','". $pengarang."','". $penerbit."')");

    if($queryResult){
        $result['pesan'] = 'data berhasil ditambahkan';
    }else{
        $result['pesan'] = 'data gagal ditambahkan';
    }
}


echo json_encode($result);