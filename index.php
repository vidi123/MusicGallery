<?php

$konek = mysqli_connect("localhost", "root", "", "okeskuy");

$lagu = mysqli_query($konek,"SELECT * FROM musics");

if( isset($_POST["search"]) ){
  var_dump($_POST["search"]);
  $judul = $_POST["search"];
  $lagu = mysqli_query($konek, "SELECT * FROM musics WHERE name LIKE '%$judul%'");
};
// while($hasil = mysqli_fetch_assoc($lagu)){
//   var_dump($hasil);
// };

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Music Player</title>
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
        padding: 0px 20px;
      }
      .logo {
        width: auto;
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
        /* border: 1px solid white; */
        overflow: hidden;
      }
      .logo .logo-img img{
        width: 30px;
        height: 30px;
        /* border: 1px solid white; */

      }
      nav .pencarian{
        width:40%;
        display: flex;
        /* border: 1px solid white; */
      }
      input {
        width: 85%;
        height: 40px;
        padding-left: 20px;
        box-sizing: border-box;
        border-radius: 7px 0px 0px 7px;
        background: rgba(128, 128, 128, 0.39);
        border: 1px solid gray;
        font-size: medium;
        font-weight: 600;
        color: white;
      }
      input:focus{
        outline: none;
      }
      nav .cari{
        background: #000;
        border:1px solid white;
        color: white;
        width: 15%;
        box-sizing: border-box;
        border-radius: 0px 7px 7px 0px;
        cursor: pointer;
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
      header a {
        width: 200px;
        height: 40px;
        margin-right: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        text-decoration: none;

        background-color: rgba(128, 128, 128, 0.39);
        border-radius: 50px;
        font-size: large;
        font-weight: 600;
        color: white;
        transition: 0.2s;
      }
      header a:hover {
        background-color: rgba(128, 128, 128, 0.575);
        box-sizing: border-box;
      }
      ul {
        width: 80%;
        display: flex;
        flex-direction: column;
        gap: 10px;
      }
      ul a{
        text-decoration:none;
        color:white;
        width: 100%;
      }
      ul li {
        /* width:100%; */
        list-style: none;
      }
      ul li span{
        font-weight:600;
      }
      ul li .lagu {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        box-sizing: border-box;
        border-bottom: 1px solid rgba(128, 128, 128, 0.39);
      }
      ul li .lagu .lagu-img {
        width: 40px;
        height: 40px;
        border-radius: 5px;
        border: 1px solid white;
        box-sizing: border-box;
        overflow: hidden;
      }
      ul li .lagu .lagu-detail {
        display: flex;
        gap: 15px;
      }
      ul li .lagu .lagu-durasi{
        display: flex;
        align-items: center;
        gap: 15px;
      }
      .delete{
        padding: 5px 10px;
        font-size: larger;
        /* box-sizing:border-box; */
        border: 1px solid white;
        border-radius: 5px;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <nav>
        <div class="logo">
          <div class="logo-img">
            <img src="./images/DefaultImg.png">
          </div>
          Musiqu
        </div>
        <form class="pencarian" method="post">
          <input type="text" name="search" placeholder="Cari Lagu" autocomplete="off"/>
          <button class="cari">Cari</button>
        </form>
          <div class="account">
          <div class="user"></div>
        </div>
      </nav>
      <main>
        <header>
          <div class="title">
            <h1>Playlist Ku</h1>
            <p>2 lagu</p>
          </div>
          <a href="create.php">+ Add Music</a>
        </header>
        <hr width="80%" />
        <ul>
        <?php foreach($lagu as $l) : ?>
          <li>
            <div class="lagu">
              <a href="singleLagu.php?nama=<?= $l['name'];?>&artis=<?= $l['artist'];?>&image=<?= $l['image']?>&music=<?= $l['music']?>">
              <div class="lagu-detail">
                <div class="lagu-img">
                  <img src="./images/<?= $l['image']?>" width="100%" height="100%">
                </div>
                <div class="lagu-desc">
                  <span><?php echo $l["name"] ?></span>
                  <p><?= $l["artist"] ?></p>
                </div>
              </div>
            </a>
              <div class="lagu-durasi">
                <span class="durasi">3.23</span>
                <a class="delete" href="delete.php?name=<?= $l["name"]; ?>" onclick="return confirm('yakin menghapus lagu <?= $l['name'] ?>?')">✖</a>
              </div>
            </div>
          </li>
        <?php endforeach; ?>
        </ul>
      </main>
      <footer></footer>
    </div>
  </body>
</html>
