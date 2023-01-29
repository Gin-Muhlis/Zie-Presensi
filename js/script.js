const keyword = document.getElementById("keyword");
const buttonCari = document.getElementById("button-cari");
const dataField = document.querySelector(".data-field");
let dataKelas = dataField.getAttribute("data-kelas");

keyword.addEventListener("keyup", function() {
    const xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            dataField.innerHTML = xhr.responseText;
        }
    }

    xhr.open("GET", `../../ajax/data.php?keyword=${keyword.value}&dataKelas=${dataKelas}`);
    xhr.send();
    
})