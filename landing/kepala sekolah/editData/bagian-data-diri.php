   <?php
    require "../../../koneksi.php";
    require "../../../functions/login_function.php";


    include("../../../data/data_guru.php");

    ?>


   <div class="form-head">
       <div class="text">
           <span id="profile">Edit Profile</span>
       </div>
       <div class="text">
           <span class="active" id="dataDiri">Edit Data Pribadi</span>
       </div>
   </div>
   <form action="" method="POST" enctype="multipart/form-data" class="form-body">
       <label for="nama">
           <span>Nama Lengkap</span>
           <input type="text" name="nama" id="nama" value="<?= ucwords($dataUser["nama"]) ?>">
       </label>
       <label for="alamat">
           <span>Alamat</span>
           <input type="text" name="alamat" id="alamat" value="<?= ucwords($dataUser["alamat"]) ?>">
       </label>
       </label>
       <label for="kontak">
           <span>Kontak</span>
           <input type="text" name="kontak" id="kontak" value="<?= $dataUser["kontak"] ?>">
       </label>
       <div class="button-area">
           <button name="editDataDiri">Edit</button>
       </div>
   </form>

   <script>
       $(document).ready(function() {

           $("#dataDiri").on("click", function() {
               $.get("bagian-data-diri.php", function(data) {
                   $(".form").html(data);
               })
           })

           $("#profile").on("click", function() {
               $.get("bagian-profile.php", function(data) {
                   $(".form").html(data);
               })
           })


       })
   </script>