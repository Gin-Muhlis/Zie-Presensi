$("document").ready(function() {
    $("#keyword").change(function() {
        console.log("hello world")
        $.get(`../../../ajax/data_find_agenda.php?keyword=${$(this).val()}&dataKelas=${$('.data-field').attr('data-kelas')}`, function(data) {
            $('.data-field').html(data);
        })
    })
})
