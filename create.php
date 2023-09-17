<?php
// coba create db

$konek = mysqli_connect("localhost", "root", "", "okeskuy");
// if(mysqli_query($konek,"CREATE DATABASE okeskuy")){
//   echo "database berhasil dibuat";
// } else {
//   echo "database gagal dibuat " . mysqli_error($konek);
// };
try {
  $conn = new PDO("mysql:host=localhost", "root", "");
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "CREATE DATABASE okeskuy";
  // use exec() because no results are returned
  $conn->exec($sql);
  // echo "Database created successfully<br>";
  $tabel =  "CREATE TABLE `okeskuy`.`musics` (`name` VARCHAR(50) NOT NULL , `artist` VARCHAR(50) NOT NULL , `image` VARCHAR(100) NOT NULL ) ENGINE = InnoDB";
  $conn->exec($tabel);

} catch(PDOException $e) {
  // echo $sql . "<br>" . $e->getMessage();
};
// $conn = null;
if(isset($_POST["submit"])){
  // echo $_POST["nama-lagu"], $_POST["artis-lagu"];
  // $konek global;
  $namaLagu = $_POST["nama-lagu"];
  $artisLagu = $_POST["artis-lagu"];
  // jan lupa input lagu
  $tmpGambar = $_FILES["gambar"]["tmp_name"];
  $tmpLagu = $_FILES["file-lagu"]["tmp_name"];
  $fileGambar = $_FILES["gambar"]["name"];
  $fileLagu = $_FILES["file-lagu"]["name"];
  if($fileGambar == ""){
    $fileGambar = "DefaultImg.png";
  };
  mysqli_query($konek, "INSERT INTO musics VALUES ('$namaLagu','$artisLagu','$fileLagu','$fileGambar')");
  move_uploaded_file($tmpGambar, './images/' . $fileGambar);
  move_uploaded_file($tmpLagu, './musics/' . $fileLagu);
  // var_dump($tmpGambar);
  var_dump($_FILES);
  var_dump($_POST);

};


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tambah Lagu</title>
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

      /* main */
      main {
        min-height: 80vh;
        padding: 20px 0px;
        display: flex;
        flex-direction: column;
        /* justify-content: center; */
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
        /* justify-content: center; */
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
      form .input-kiri .box-input button {
        width: 200px;
        height: 40px;
        margin-top: 25px;
        display: flex;
        justify-content: center;
        align-items: center;
        text-decoration: none;

        background-color: rgba(128, 128, 128, 0.39);
        /* border: 1px solid white; */
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
        /* border: 1px solid white; */
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
        /* background-position:center; */
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
            <h1>Tambah Lagu</h1>
          </div>
        </header>
        <hr width="80%" />
        <form action="" method="post" enctype="multipart/form-data">
          <div class="input-kiri">
            <div class="box-input">
              <label for="nama-lagu">
                <span>Nama lagu </span>
              </label>
              <input type="text" name="nama-lagu" id="nama-lagu" autocomplete="off" />
              <label for="artis-lagu">
                <span>Penyanyi lagu </span>
              </label>
              <input type="text" name="artis-lagu" id="artis-lagu" autocomplete="off"/>
              <label for="file-lagu">
                <span>File lagu</span>
              </label>
              <input type="file" name="file-lagu" required/>
              <button name="submit">+ Tambah</button>
            </div>
          </div>
          <div class="input-kanan">
            <div class="box-input">
              <span>Gambar lagu</span>
              <label for="gambar" class="preview"></label>
              <input type="file" name="gambar" id="gambar" hidden/>
              <!-- kalo gk bisa labelnya name = id -->
            </div>
          </div>
        </form>
      </main>
    </div>
    <script>
      let gambar = document.querySelector("#gambar");
      const preview = document.querySelector(".preview");
      gambar.addEventListener("change", function(){
        if(this.files.length == 0){
          preview.style.backgroundImage = 'none';
        } else{
          console.log(this.files[0]);
          let imageFiles = this.files[0]; // return File
          let imgSrc = URL.createObjectURL(imageFiles); // buat srcnya
          preview.style.backgroundImage = `url(${imgSrc})`;
        } 
      });
    </script>
  </body>
</html>
