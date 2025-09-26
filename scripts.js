function enableEditing(id) {
    let fields = ['nome','inscricao','descricao'];
    fields.forEach(function(col){
        let cell = document.getElementById(col + '-' + id);
        cell.contentEditable = true;
        cell.style.backgroundColor = "#d4f5d4";
    });
}

function updateData(element, column, id) {
    var value = element.innerText;
    element.contentEditable = false;
    element.style.backgroundColor = "";

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('statusMessage').innerText = this.responseText;
            setTimeout(function() {
                document.getElementById('statusMessage').innerText = '';
            }, 3000);
        }
    };
    xhttp.open("POST", "visualizar_cadastros.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("id=" + id + "&column=" + column + "&value=" + encodeURIComponent(value));
}

function deleteRow(id) {
    if (confirm("Tem certeza que deseja excluir este torcedor?")) {
        window.location.href = 'visualizar_cadastros.php?delete=' + id;
    }
}

// Adiciona evento onBlur para todas as células editáveis
document.addEventListener("DOMContentLoaded", function() {
    let editableCells = document.querySelectorAll("td[contenteditable='true']");
    editableCells.forEach(cell => {
        cell.addEventListener("blur", function() {
            let idParts = cell.id.split("-");
            updateData(cell, idParts[0], idParts[1]);
        });
    });
});
