$("document").ready(function() {
    $("#keyword").on("keyup", function() {

        $.get(`../../../ajax/data.php?keyword=${$("#keyword").val()}&dataKelas=${$(".data-field").attr("data-kelas")}`, function(data) {
            $(".data-field").html(data);
        })

    })

})