<?php
require 'login.kontrol.php';

require 'sayfa.ust.php'; ?>




<div class=' container text-center '>
    <h1 class='alert alert-primary'>Rehber</h1>
</div>

<form class="text-center">
    <p> Aranan isim <input type="text" name="isim_form">
        <input type="submit" value="Rehberde Ara" class="btn btn-primary">
    </p>
</form>


<table class=" container table table-bordered table-striped">
    <thead>
        <tr>

            <th>Adı Soyadı</th>
            <th>Birimi</th>
            <th>Telefonu</th>

        </tr>
    </thead>
    <tbody>




        <?php

        require_once('db.php');

        if (isset($_GET['isim_form'])) {
            $ArananAd = $_GET['isim_form'];
            $ArananAd = "%{$ArananAd}%";
        } else {
            $ArananAd = "%";
        }


        $sql = "SELECT * FROM kullanicilar WHERE adsoyad LIKE :isim_form LIMIT 100 ";

        $SORGU = $DB->prepare($sql);


        $SORGU->bindParam(':isim_form',  $ArananAd);

        $SORGU->execute();
        $kullanicilar = $SORGU->fetchAll(PDO::FETCH_ASSOC);
        //echo '<pre>'; print_r($users);

        foreach ($kullanicilar as $kullanici) {
            echo "
    <tr>
      <td>{$kullanici['adsoyad']}</td>
    
      <td>{$kullanici['birim']}</td>
      <td>{$kullanici['telefon']}</td>
     
   </tr> 
  ";
        }

        ?>

    </tbody>
</table>




<div class='text-center'>
    <a href='index.php' class='btn btn-warning'>ANASAYFAYA</a>
</div>


<?php
require 'sayfa.alt.php' ?>