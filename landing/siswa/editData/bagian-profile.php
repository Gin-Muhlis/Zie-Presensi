   <?php
    require "../../../koneksi.php";
    require "../../../functions/login_function.php";


    include("../../../data/data_siswa.php");

    ?>

   <div class="form-head">
       <div class="text">
           <span class="active" id="profile">Edit Profile</span>
       </div>
       <div class="text">
           <span id="dataDiri">Edit Data Pribadi</span>
       </div>
   </div>
   <form action="" method="POST" enctype="multipart/form-data" class="form-body">
       <label for="username">
           <span>Username</span>
           <input type="text" name="username" id="username" value="<?= $dataUser["username"] ?>">
       </label>
       <label for="pwLama">
           <span>Password Lama</span>
           <input type="password" name="pwLama" id="pwLama">
       </label>
       </label>
       <label for="pwBaru">
           <span>Password Baru</span>
           <input type="password" name="pwBaru" id="pwBaru">
       </label>
       <div class="button-area">
           <button name="editProfile">Edit</button>
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
               console.log("hello")
           })


       })
   </script>