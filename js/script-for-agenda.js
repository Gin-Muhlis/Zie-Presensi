$("document").ready(function() {
    $("#keyword").change(function() {
        
        $.get(`../../../ajax/data_find_agenda.php?keyword=${$(this).val()}&dataKelas=${$('.data-field').attr('data-kelas')}`, function(data) {
            $('.data-field').html(data);
        })
    })

    $("allData").click(function() {
        $.get(`../../../ajax/allData.php?dataKelas=${$('.data-field').attr('data-kelas')}`, function(data) {
            $('.data-field').html(data);
        })
    })
})
