<?php

$konek = mysqli_connect("localhost", "root", "", "okeskuy");

$namaLagu = $_GET["name"];
mysqli_query($konek, "DELETE FROM musics WHERE name = '$namaLagu';");

echo "<script>
    alert('lagu berhasil dihapus');
    window.location.href = 'index.php';
</script>";
?>
