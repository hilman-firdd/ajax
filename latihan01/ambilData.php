<?php

include 'koneksi.php';

$query = $conn->query('SELECT * FROM tb_buku');
$result = array();

while($fetchData = $query->fetch_assoc()){
    $result[] = $fetchData;
}

echo json_encode($result);

?>