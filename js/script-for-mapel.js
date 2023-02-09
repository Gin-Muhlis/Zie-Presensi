$("document").ready(function() {
    $("#hari").change(function() {
        
        $.get(`../../ajax/find_mapel.php?keyword=${$(this).val()}&kelas=${$('.data-field').attr('data-kelas')}`, function(data) {
            $('.data-field').html(data)
        })
    })

})
