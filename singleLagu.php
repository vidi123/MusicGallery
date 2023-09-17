<?php

var_dump($_GET);    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>singleLagu</title>
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
        border:1px solid goldenrod;
      }
      section{
        width: 80%;
        display: flex;
        padding:20px;
        justify-content: space-between;
        /* align-items: center; */
        border:1px solid green;
      }
      .gambar{
        width:400px;
      }
      .gambar img{
        width:100%;
        height:400px;
        border-radius: 10px;
      }
      .deskripsi{
        width:50%;
        /* height:; */
        border:1px solid red;
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: center;
        gap: 30px;
        position: relative;
      }
      .deskripsi h2{
        font-size:31px;
      }
      .deskripsi span{
        font-size:larger;
      }
      .music-wraper{
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
      }
      .music-wraper .track-box{
        width: 300px;
        border-radius: 50px;
        background: #181818;
        overflow: hidden;
        cursor: pointer;
      }
      .music-wraper .track-box .track{
        width: 0%;
        height: 15px;
        background: white;
        transition: 0.1s;
      }
      button{
        width: 70px;
        height: 70px;
        font-size: 30px;
        padding-bottom: 5px;
        font-weight: 700;
        border-radius: 50%;
        border: 1px solid white;
        background: #000;
        color: white;
        cursor: pointer;
        margin-top: 20px;
      }
      details{
        width: 40px;
        height:40px;
        /* background: transparent; */
        border: 1px solid white;
        position: absolute;
        top: 0px;
        right: 0px;
        border-radius: 7px;
        cursor: pointer;
      }
      details summary{
        width: 40px;
        height:40px;
        /* background: blue; */
        justify-content:center;
        /* align-items: center; */
        line-height:37px;
        display: flex;
        gap: 5px;
        list-style: none;
      }
      .deskripsi details span{
        font-size:17px;
        z-index: -1;
      }
      details ul{
        width: 100px;
        border: 1px solid white;
        margin-top: 5px;
        margin-left:-60px;
        border-radius: 7px;
        padding: 5px;
        box-sizing:border-box;
      }
      details ul li {
        height: 40px;
        display:flex;
        justify-content: center;
        align-items:center;
        list-style: none;
        border-radius: 7px;
        box-sizing: border-box;
        transition: 0.2s;
      }
      details ul li:hover {
        /* border: 1px solid white; */
        background: white;
        color: black;
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
        <section>
            <div class="gambar">
                <img src="./images/<?= $_GET["image"] ?>">
            </div>
            <div class="deskripsi">
                <details>
                  <summary class="edit">
                    <span>•</span>
                    <span>•</span>
                    <span>•</span>
                  </summary>
                  <ul>
                    <li>Edit Info</li>
                  </ul>
                </details>
                <h2><?= $_GET["nama"] ?></h2>
                <span><?= $_GET["artis"] ?></span>
                <div class="music-wraper">
                  <audio controls src="./musics/<?= $_GET['music']?>" class="music" hidden></audio>
                  <div class="track-box">
                    <div class="track"></div>
                  </div>
                  <button class="play">▶︎</button>
                </div>
            </div>
        </section>
    </main>
</div>
<script>
  let music = document.querySelector(".music");
  let trackBox = document.querySelector(".track-box");
  let track = document.querySelector(".track");
  let playMusic = document.querySelector(".play");

  // play pause music
  let onPlay = false;
  playMusic.addEventListener("click", (e)=>{
    if(!onPlay){
      music.play();
      onPlay = true;
      e.target.textContent = "| |";
    } else{
      music.pause();
      onPlay = false;
      e.target.textContent = "▶︎";
    }

  });

  // update track
  music.addEventListener("timeupdate", (e)=>{
    // panjang durasi
    let durasiLagu = e.target.duration;
    // alur track sampai 100%
    let trackJalan = e.target.currentTime;
    let trackPersen = (trackJalan / durasiLagu) * 100;
    // masukan persen ke width track
    track.style.width = `${trackPersen}%`;
    // console.log(trackPersen);
  });
  
  // set track
  trackBox.addEventListener("click", (e)=>{
    let panjangTrack = trackBox.clientWidth;
    // menangkap berapa px width yang dipencet
    let setOn = e.offsetX;
    // mengukur durasi lagu & ubah setter ke persen
    let durasiLagu = music.duration;
    // set ke durasi yang diinginkan ( bukan persen )
    let setter = (setOn / panjangTrack) * durasiLagu;
    music.currentTime = setter;
    // console.log(durasiLagu);
    // console.log(setter);
  });

  // edit
  const edit = document.querySelector(".edit");
  window.addEventListener("click", (e)=>{
    // console.log(e.target.className);
    if(e.target !== edit){
      edit.parentElement.removeAttribute("open");
      // console.log(edit.parentElement);
    }
  });
  
</script>
</body>
</html>