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