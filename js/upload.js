$ ("document").ready (function() {
    $ (".text-foto").on ("click", function() {
        $ (".wrapper-popup").addClass ("show")
    })

    $ (".close-popup").on ("click", function() {
        $ (".wrapper-popup").removeClass ("show")
    })


    // $ ("#image").on ("change", function() {
    //     let fileName = this.file
    // })
})