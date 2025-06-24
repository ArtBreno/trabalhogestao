
<?php session_start(); 
// Redirecionar se já estiver logado
if(isset($_SESSION['logado']) && $_SESSION['logado']) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<!-- ... restante do código ... -->

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - WITW</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="cadcss.css">
    
</head>
<body>
    <div class="cadastro-container">
        <div class="cadastro-header">
            <h1>Crie sua conta</h1> 
             
            <p>Junte-se à nossa comunidade hoje mesmo</p>
        </div>
        
        <form>
            <div class="form-group">
                <label for="nome">Nome completo</label>
                <input type="text" id="nome" class="form-control" placeholder="Digite seu nome completo" required>
            </div>
            
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" class="form-control" placeholder="Digite seu e-mail" required>
            </div>
            
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" id="senha" class="form-control" placeholder="Crie uma senha forte" required>
            </div>
            
            <div class="form-group">
                <label for="confirmar-senha">Confirmar senha</label>
                <input type="password" id="confirmar-senha" class="form-control" placeholder="Confirme sua senha" required>
            </div>
            
            <button type="submit" class="btn">Cadastrar</button>
            
            <div class="login-link">
                <a href="index.php">voltar</a>
                <br>
                Já tem uma conta? <a href="login.php">Faça login</a>
            </div>
        </form>
    </div>
   
    <!-- Footer igual ao index.php -->
    <footer>
        <div class="social-links">
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-pinterest"></i></a>
        </div>
        <p class="copyright">© 2025 WITW. Todos os direitos reservados.</p>
    </footer>
</body>
</html>