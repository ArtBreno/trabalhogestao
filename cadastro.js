
document.addEventListener('DOMContentLoaded', function() {
    const formCadastro = document.getElementById('formCadastro');
    const mensagemDiv = document.getElementById('mensagem');

    formCadastro.addEventListener('submit', function(e) {
        e.preventDefault();

        // Obter valores dos campos
        const nome = document.getElementById('nome').value;
        const email = document.getElementById('email').value;
        const senha = document.getElementById('senha').value;
        const confirmarSenha = document.getElementById('confirmar-senha').value;

        // Validar senhas
        if (senha !== confirmarSenha) {
            mostrarMensagem('As senhas não coincidem!', 'erro');
            return;
        }

        // Enviar dados para o servidor
        const dados = {
            nome: nome,
            email: email,
            senha: senha
        };

        // Configuração da requisição
        fetch('insert_cadastro.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(dados)
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'sucesso') {
                mostrarMensagem(data.mensagem, 'sucesso');
                formCadastro.reset();
            } else {
                mostrarMensagem(data.mensagem, 'erro');
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            mostrarMensagem('Erro ao conectar com o servidor.', 'erro');
        });
    });

    function mostrarMensagem(texto, tipo) {
        mensagemDiv.textContent = texto;
        mensagemDiv.style.display = 'block';
        mensagemDiv.className = tipo; // Adiciona classe para estilização

        // Esconder a mensagem após 5 segundos
        setTimeout(() => {
            mensagemDiv.style.display = 'none';
        }, 5000);
    }
});
