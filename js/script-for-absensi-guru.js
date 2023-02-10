$("document").ready(function() {
    $("#keyword").keyup(function() {
        
        $.get(`../../ajax/find_data_absensi_guru.php?keyword=${$(this).val()}`, function(data) {
            $('.data-field').html(data);
        })
    })
})
