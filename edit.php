<?php
    $konek = mysqli_connect("localhost", "root", "", "okeskuy");

    if(isset($_POST["submit"])){
        var_dump($_POST);
        var_dump($_FILES);
        $namaLagu = $_POST["nama-lagu"];
        $artisLagu = $_POST["artis-lagu"];
        $tmpGambar = $_FILES["gambar"]["tmp_name"];
        $fileGambar = $_FILES["gambar"]["name"];

        if($fileGambar == ""){
            $fileGambar = "DefaultImg.png";
        } else{
            move_uploaded_file($tmpGambar, './images/' . $fileGambar);
        };
        mysqli_query($konek, "UPDATE musics SET name = '$namaLagu', artist = '$artisLagu', image = '$fileGambar'; ");
    };
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
            * {
        margin: 0;
        padding: 0;
        font-family: system-ui;
      }
      body {
        background: #000;
        color: white;
      }
      nav {
        width: 100%;
        height: 60px;
        box-sizing: border-box;
        display: flex;
        justify-content: space-between;
        align-items: center;
      }
      .logo {
        width: 10%;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 3px;
        font-size: 30px;
        font-weight: bold;
      }
      .logo .logo-img {
        width: 30px;
        height: 30px;
        border-radius: 50px;
        background-color: gray;
      }
      input {
        width: 40%;
        height: 40px;
        padding-left: 20px;
        box-sizing: border-box;
        border-radius: 7px;
        background: rgba(128, 128, 128, 0.39);
        border: 1px solid gray;
        font-size: medium;
        font-weight: 600;
        color: white;
      }
      .account {
        width: 20%;
        display: flex;
        justify-content: center;
      }
      .user {
        width: 40px;
        height: 40px;
        border-radius: 50px;
        background-color: lightgreen;
      }

      main {
        min-height: 80vh;
        padding: 20px 0px;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
      }
      header {
        width: 80%;
        display: flex;
        justify-content: space-between;
        align-items: center;
      }
      form {
        width: 80%;
        display: flex;
      }
      form div {
        width: 50%;
        display: flex;
        flex-direction: column;
        align-items: center;
      }
      form div .box-input {
        width: 75%;
        align-items: baseline;
        gap: 10px;
      }
      form .box-input span {
        font-weight: 600;
      }
      form .input-kiri input {
        width: 100%;
      }
      form .input-kiri input:nth-child(6) {
        opacity: 0.7;
      }
      form .input-kiri input:nth-child(6):hover {
        cursor: not-allowed;
      }
      form .input-kiri .box-input button {
        width: 200px;
        height: 40px;
        margin-top: 25px;
        display: flex;
        justify-content: center;
        align-items: center;
        text-decoration: none;
        background-color: rgba(128, 128, 128, 0.39);
        border: none;
        border-radius: 50px;
        font-size: large;
        font-weight: 600;
        color: white;
        transition: 0.2s;
        cursor: pointer;
      }
      form .input-kiri .box-input button:hover {
        background-color: rgba(128, 128, 128, 0.575);
        box-sizing: border-box;
      }
      form .input-kanan {
        align-items: center;
      }
      form .input-kanan label {
        width: 200px;
        height: 200px;
        background-size:cover;
        background-repeat:no-repeat;
        border-radius: 50%;
        background-color: rgba(128, 128, 128, 0.39);
        cursor: pointer;
      }
    </style>
</head>
<body>
<div class="container">
    <nav> 
        <div class="logo">
            <div class="logo-img"></div>
            <p>Musiqu</p>
        </div>
        <input type="text" placeholder="Cari Lagu" />
        <div class="account">
            <div class="user"></div>
        </div>
    </nav>
    <main>
        <header>
          <div class="title">
            <h1>Edit Informasi Lagu</h1>
          </div>
        </header>
        <hr width="80%" />
        <form action="" method="post" enctype="multipart/form-data">
          <div class="input-kiri">
            <div class="box-input">
              <label for="nama-lagu">
                <span>Nama lagu </span>
              </label>
              <input type="text" name="nama-lagu" id="nama-lagu" value="<?=$_GET["nama"]?>" autocomplete="off" />
              <label for="artis-lagu">
                <span>Penyanyi lagu </span>
              </label>
              <input type="text" name="artis-lagu" id="artis-lagu" value="<?=$_GET["artis"]?>" autocomplete="off"/>
              <label for="file-lagu">
                <span>File lagu</span>
              </label>
              <input type="text" name="file-lagu" value="<?=$_GET["music"]?>" disabled/>
              <button name="submit">Simpan</button>
            </div>
          </div>
          <div class="input-kanan">
            <div class="box-input">
              <span>Gambar lagu</span>
              <label for="gambar" class="preview" style="background-Image: url(./images/<?=$_GET["image"]?>);"></label>
              <input type="file" name="gambar" id="gambar" hidden/>
            </div>
          </div>
        </form>
      </main>
</div>
<script>
    let gambar = document.querySelector("#gambar");
    let preview = document.querySelector(".preview");
    gambar.addEventListener("change", (e)=>{
        if(e.target.files.length == 1){
            let imgFile = e.target.files[0];
            let imgSrc = URL.createObjectURL(imgFile);
            preview.style.backgroundImage = `url(${imgSrc})`;
        } else{
            preview.style.backgroundImage = "url(./images/<?=$_GET["image"]?>)";
        }
    });

</script>
</body>
</html>