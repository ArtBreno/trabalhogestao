
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - WITW</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="logincss.css">
    <style>
        /* Adicionado para mensagens */
        #mensagem {
            display: none;
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1>Bem-vindo de volta</h1>
            <p>Faça login para acessar sua conta</p>
        </div>
        
        <div class="login-form">
            <!-- Div para mensagens -->
            <div id="mensagem"></div>
            
            <form id="loginForm">
                <div class="form-group">
                    <label for="email"><i class="fas fa-envelope"></i> E-mail</label>
                    <div class="input-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <input type="email" id="email" class="form-control" placeholder="Digite seu e-mail" required>
                </div>
                
                <div class="form-group">
                    <label for="senha"><i class="fas fa-lock"></i> Senha</label>
                    <div class="input-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <input type="password" id="senha" class="form-control" placeholder="Digite sua senha" required>
                </div>
                
                <div class="remember-forgot">
                    <div class="remember-me">
                        <input type="checkbox" id="remember">
                        <label for="remember">Lembrar-me</label>
                    </div>
                    <div class="forgot-password">
                        <a href="#">Esqueceu a senha?</a>
                    </div>
                </div>
                
                <button type="submit" class="btn">Entrar</button>
            </form>
            
            <div class="social-login">
                <p>Ou continue com</p>
                <div class="social-icons">
                    <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="google"><i class="fab fa-google"></i></a>
                    <a href="#" class="twitter"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
            
            <div class="signup-link">
                 <a href="index.php">voltar</a>
                 <br>
                Não tem uma conta? <a href="cadastro.php">Cadastre-se</a>
            </div>
        </div>
    </div>
    
    <p class="copyright">© 2025 WITW. Todos os direitos reservados.</p>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const loginForm = document.getElementById('loginForm');
        const mensagemDiv = document.getElementById('mensagem');

        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const email = document.getElementById('email').value;
            const senha = document.getElementById('senha').value;

            // Enviar dados para o servidor
            const dados = {
                email: email,
                senha: senha
            };

            fetch('login_action.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(dados)
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'sucesso') {
                    mensagemDiv.textContent = data.mensagem;
                    mensagemDiv.className = 'sucesso';
                    mensagemDiv.style.display = 'block';
                    
                    // Redirecionar após 1.5 segundos
                    setTimeout(() => {
                        window.location.href = 'index.php';
                    }, 1500);
                } else {
                    mensagemDiv.textContent = data.mensagem;
                    mensagemDiv.className = 'erro';
                    mensagemDiv.style.display = 'block';
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                mensagemDiv.textContent = 'Erro ao conectar com o servidor.';
                mensagemDiv.className = 'erro';
                mensagemDiv.style.display = 'block';
            });
        });
    });
    </script>
</body>
</html>
