$("document").ready(function() {
    $("#kelas").change(function() {
                                                 
        const keyword = $(this).val();

        const tingkat = keyword.split(" ")[0];
        const bidang = `${keyword.split(" ")[1]} ${keyword.split(" ")[2]} ${keyword.split(" ")[3]}`;
        const rombel = keyword.split(" ")[4];

        $.get(`../../data/filter_absensi_siswa.php?tingkat=${tingkat}&bidang=${bidang}&rombel=${rombel}`, function(data) {
            $(".data-field").html(data);
        })
    })

})
