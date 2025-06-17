<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Cadastro e Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
            font-size: 0.8em;
        }
        .success {
            color: green;
            font-size: 1em;
            margin-top: 10px;
        }
        .tabs {
            display: flex;
            margin-bottom: 20px;
        }
        .tab {
            padding: 10px 20px;
            cursor: pointer;
            background-color: #f1f1f1;
            margin-right: 5px;
        }
        .tab.active {
            background-color: #4CAF50;
            color: white;
        }
        .form-container {
            display: none;
        }
        .form-container.active {
            display: block;
        }
    </style>
</head>
<body>
    <h2>Sistema de Usuário</h2>
    
    <div class="tabs">
        <div class="tab active" onclick="openTab('cadastro')">Cadastro</div>
        <div class="tab" onclick="openTab('login')">Login</div>
    </div>
    
    <div id="cadastroFormContainer" class="form-container active">
        <h3>Cadastro de Usuário</h3>
        <form id="cadastroForm">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha (mínimo 6 caracteres):</label>
                <input type="password" id="senha" required minlength="6">
                <div id="senhaError" class="error"></div>
            </div>
            <div class="form-group">
                <label for="confirmarSenha">Confirmar Senha:</label>
                <input type="password" id="confirmarSenha" required>
                <div id="confirmarSenhaError" class="error"></div>
            </div>
            <button type="submit">Cadastrar</button>
        </form>
        <div id="mensagemSucesso" class="success"></div>
    </div>
    
    <div id="loginFormContainer" class="form-container">
        <h3>Login</h3>
        <form id="loginForm">
            <div class="form-group">
                <label for="loginEmail">E-mail:</label>
                <input type="email" id="loginEmail" required>
            </div>
            <div class="form-group">
                <label for="loginSenha">Senha:</label>
                <input type="password" id="loginSenha" required>
                <div id="loginError" class="error"></div>
            </div>
            <button type="submit">Entrar</button>
        </form>
        <div id="loginSuccess" class="success"></div>
    </div>

    <script>
        // Função para alternar entre as abas
        function openTab(tabName) {
            // Esconde todos os containers de formulário
            document.querySelectorAll('.form-container').forEach(container => {
                container.classList.remove('active');
            });
            
            // Remove a classe active de todas as abas
            document.querySelectorAll('.tab').forEach(tab => {
                tab.classList.remove('active');
            });
            
            // Mostra o container do formulário selecionado
            document.getElementById(tabName + 'FormContainer').classList.add('active');
            
            // Adiciona a classe active à aba selecionada
            event.currentTarget.classList.add('active');
        }
        
        // Cadastro de usuário
        document.getElementById('cadastroForm').addEventListener('submit', function(event) {
            event.preventDefault();
            
            // Limpar mensagens de erro anteriores
            document.getElementById('senhaError').textContent = '';
            document.getElementById('confirmarSenhaError').textContent = '';
            document.getElementById('mensagemSucesso').textContent = '';
            
            // Obter valores dos campos
            const nome = document.getElementById('nome').value;
            const email = document.getElementById('email').value;
            const senha = document.getElementById('senha').value;
            const confirmarSenha = document.getElementById('confirmarSenha').value;
            
            // Validar senha
            let valido = true;
            
            if (senha.length < 6) {
                document.getElementById('senhaError').textContent = 'A senha deve ter pelo menos 6 caracteres.';
                valido = false;
            }
            
            if (senha !== confirmarSenha) {
                document.getElementById('confirmarSenhaError').textContent = 'As senhas não coincidem.';
                valido = false;
            }
            
            // Verificar se o email já está cadastrado
            const usuarios = JSON.parse(localStorage.getItem('usuarios')) || [];
            const usuarioExistente = usuarios.find(u => u.email === email);
            
            if (usuarioExistente) {
                document.getElementById('senhaError').textContent = 'Este e-mail já está cadastrado.';
                valido = false;
            }
            
            // Se tudo estiver válido, cadastrar o usuário
            if (valido) {
                const novoUsuario = {
                    nome,
                    email,
                    senha // EM UM SISTEMA REAL, NUNCA ARMAZENE SENHAS EM CLEAR TEXT! Use hash (bcrypt, etc.)
                };
                
                usuarios.push(novoUsuario);
                localStorage.setItem('usuarios', JSON.stringify(usuarios));
                
                document.getElementById('mensagemSucesso').textContent = `Cadastro realizado com sucesso para ${nome}!`;
                document.getElementById('cadastroForm').reset();
                
                // Alternar para a aba de login automaticamente
                setTimeout(() => {
                    document.querySelector('.tab:nth-child(2)').click();
                }, 1500);
            }
        });
        
        // Login de usuário
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault();
            
            // Limpar mensagens anteriores
            document.getElementById('loginError').textContent = '';
            document.getElementById('loginSuccess').textContent = '';
            
            // Obter valores dos campos
            const email = document.getElementById('loginEmail').value;
            const senha = document.getElementById('loginSenha').value;
            
            // Verificar credenciais
            const usuarios = JSON.parse(localStorage.getItem('usuarios')) || [];
            const usuario = usuarios.find(u => u.email === email && u.senha === senha);
            
            if (usuario) {
                document.getElementById('loginSuccess').textContent = `Bem-vindo, ${usuario.nome}! Login realizado com sucesso.`;
                document.getElementById('loginForm').reset();
                
                // Aqui você redirecionaria para a área logada ou mostraria conteúdo restrito
                // window.location.href = '/area-restrita.html';
            } else {
                document.getElementById('loginError').textContent = 'E-mail ou senha incorretos.';
            }
        });
    </script>
</body>
</html>
