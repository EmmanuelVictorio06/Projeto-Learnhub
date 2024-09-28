const formulario = document.querySelector('form');
const campoUsuario = document.getElementById('usuario');
const campoSenha = document.getElementById('senha');
const mensagemErro = document.getElementById('mensagem-erro');

formulario.addEventListener('submit', (event) => {
    event.preventDefault();

    const usuario = campoUsuario.value;
    const senha = campoSenha.value;

    if (usuario === '' || senha === '') {
        mensagemErro.textContent = 'Preencha todos os campos.';
        return;
    }

    const dados = {
        usuario: usuario,
        senha: senha
    };

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'http://localhost:3000/login'); 
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onload = function() {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.status === 'sucesso') {
                alert('Usuário autenticado com sucesso!');

            } else {
                mensagemErro.textContent = response.mensagem;
            }
        } else {
            mensagemErro.textContent = 'Erro ao conectar com o servidor.';
        }
    };
    xhr.send(JSON.stringify(dados));
});