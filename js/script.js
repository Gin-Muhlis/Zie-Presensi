const keyword = document.getElementById("keyword");
const buttonCari = document.getElementById("button-cari");
const dataField = document.querySelector(".data-field");
let dataKelas = dataField.datasat.kelas;

keyword.addEventListener("keyup", function() {
    const xhr = XMLHttpRequestt();

    xhr.onreadystatechange = function() {
        if (xhr.state == 4 && xhr.status == 200) {
            // dataField.innerHTML = xhr.responseText;
            
        }
    }

    
})