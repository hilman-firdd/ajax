<?php

include "koneksi.php";

$id = $_POST['id'];
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
    $queryResult = $conn->query("UPDATE tb_buku SET judul_buku='".$judulBuku."', pengarang='".$pengarang."', penerbit='".$penerbit."' WHERE id='".$id."'");

    if($queryResult){
        $result['pesan'] = 'data berhasil diubah';
    }else{
        $result['pesan'] = 'data gagal diubah';
    }
}


echo json_encode($result);