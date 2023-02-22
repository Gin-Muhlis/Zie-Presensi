const PDFStart = () => {
    let loadingTask = pdfjsLib.getDocument("mapel.pdf");
    let pdfDoc = null;
    let canvas = document.querySelector("#canvas");
    let ctx = canvas.getContext("2d");
    let scale = 1.5;
    let numPage = 1;
    
    let generatePDF = numPage => {
        pdfDoc.getPage(numPage).then(page => {
            let viewport = page.getViewport({scale: scale});
            canvas.width = viewport.width;
            canvas.height = viewport.height;
            
            let renderContext = {
                canvasContext: ctx,
                viewport: viewport
            }

            page.render(renderContext);
        })
    }

    loadingTask.promise.then(PDFDoc_ => {
        pdfDoc = PDFDoc_;
        generatePDF(numPage);
    })
}

const startPDF = () => {
    PDFStart();
}

window.addEventListener("load", startPDF);