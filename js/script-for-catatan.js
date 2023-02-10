$("document").ready(function() {
    $("#bulan").change(function() {
        
        $.get(`../../ajax/find_catatan.php?keyword=${$(this).val()}`, function(data) {
            $(".catatan").html(data);
        })
    })
})