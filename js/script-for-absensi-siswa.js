$("document").ready(function() {
    $("#kelas").change(function() {
        
        $.get(`../../ajax/find_data_absensi_siswa.php?keyword=${$(this).val()}`, function(data) {
            $('.data-field').html(data);
        })
    })

})
