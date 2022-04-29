<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>

<table width="100%" border=1> 
    <thead width="100%">
        <th>No</th>
        <th>Judul Buku</th>
        <th>Pengarang</th>
        <th>Penerbit</th>
        <th>Aksi</th>
    </thead>
    <tbody id="barisData">

    </tbody>
</table>

<h2>tambah data</h2>
<table>
    <tr>
        <td>ID</td>
        <td><input type="text" name="id" disabled></td>
    </tr>
    <tr>
        <td>judul buku</td>
        <td><input type="text" name="judul_buku"></td>
    </tr>
    <tr>
        <td>pengarang</td>
        <td><input type="text" name="pengarang"></td>
    </tr>
    <tr>
        <td>penerbit</td>
        <td><input type="text" name="penerbit"></td>
    </tr>
    <tr>
        <td></td>
        <td><button id="tombolTambah" onclick="tambahData()">Tambah Data</button></td>
        <td><button id="tombolUpdate" onclick="updateData()">Update Data</button></td>
    </tr>
</table>

<table>
    <p id="pesan"></p>
</table>
    
<script type="text/javascript">
onload();

    function updateData(){
        let id = $("[name='id']").val();
        let judul = $("[name='judul_buku']").val();
        let pengarang = $("[name='pengarang']").val();
        let penerbit = $("[name='penerbit']").val();

        $.ajax({
            type : 'POST',
            data : "id="+id+"&judul="+judul+"&pengarang="+pengarang+"&penerbit="+penerbit,
            url : 'update_data.php',
            success:function(result){
                let obj =JSON.parse(result);
                $('#pesan').html(obj.pesan);
                onload();
            }
        });
    }


    function tambahData(){
        let judul = $("[name='judul_buku']").val();
        let pengarang = $("[name='pengarang']").val();
        let penerbit = $("[name='penerbit']").val();

        $.ajax({
            type : 'POST',
            data : "judul="+judul+"&pengarang="+pengarang+"&penerbit="+penerbit,
            url : 'tambah_data.php',
            success:function(result){
                let obj =JSON.parse(result);
                $('#pesan').html(obj.pesan);
                onload();
            }
        });
    }

function pilihData(idx){
    let id = idx;
    $.ajax({
        type: "POST",
        data: "id="+id,
        url: "ambilID.php",
        success:function(result) {
            let obj = JSON.parse(result);
            $("[name='id']").val(obj.id);
            $("[name='judul_buku']").val(obj.judul_buku);
            $("[name='pengarang']").val(obj.pengarang);
            $("[name='penerbit']").val(obj.penerbit);
            $("#tombolTambah").hide();
            $('#tombolUpdate').show();
        }
    });
}

function hapus(id){
    let tanya = confirm("apakah anda yakin akan menghapus data buku ini ?");
    if(tanya){
        $.ajax({
        type: "POST",
        data: "id="+id,
        url: "hapus.php",
        success:function(result) {
            onload();
        }
        });
    }
    
}

function onload(){
    let nomor =1;
    let dataHandler = $('#barisData');
    dataHandler.html('');
    $.ajax({
        type: 'GET',
        data : "",
        url : 'ambilData.php',
        success:function(result){ 
            let obResult = JSON.parse(result);
            $.each(obResult, function(key, val) {
                let line = $("<tr>");
                line.html(
                    "<td>"+ nomor +"</td>"+
                    "<td>"+ val.judul_buku +"</td>"+
                    "<td>"+ val.pengarang +"</td>"+
                    "<td>"+ val.penerbit +"</td>"+
                    "<td><button onclick='pilihData("+val.id+")'>select</button></td>"+       
                    "<td><button onclick='hapus("+val.id+")'>hapus</button></td></tr>"            
                )
                dataHandler.append(line);
                nomor++;

                $('#tombolUpdate').hide();
                $('#tombolTambah').show();
            });
        }
    });
}
</script>
</body>
</html>