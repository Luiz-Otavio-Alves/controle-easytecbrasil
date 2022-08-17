function abrirCadastrado() {
    document.getElementById('popup2').style.display = 'block';
}

function fecharCadastrado(){
    document.getElementById('popup2').style.display = 'none';
}

function abrir(){
    document.getElementById('popup').style.display = 'block';
}

function fechar(){
    document.getElementById('popup').style.display = 'none';
    document.getElementById('popup1').style.display = 'none';
}

function excluirItem(){
    document.getElementById('popup').style.display = 'none';
    document.getElementById('popup1').style.display = 'block';
}
