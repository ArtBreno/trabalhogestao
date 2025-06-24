
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WITW</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="indexcss.css">
    <style>
        /* ... (estilos anteriores) ... */
        
.search-container {
    position: absolute;
    margin-left: 40%;
    transform: translateX(-110%);
    width: 35%; /* Reduzido de 45% para 35% */
    min-width: 250px; /* Reduzido de 300px para 250px */
    max-width: 400px; /* Reduzido de 600px para 500px */
}

.search-bar {
    width: 80%; /* Agora ocupa 100% do container menor */
    padding: 10px 10px; /* Reduzido o padding vertical */
    border-radius: 40px;
    border: none;
    outline: none;
    font-size: 1em; /* Fonte ligeiramente menor */
    background: rgba(255, 255, 255, 0.95);
}

.search-bar:focus {
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.35);
}

.search-bar::placeholder {
    color: #8d6e63;
}

        /* Novo estilo para dropdown de usuário */
        .user-menu {
            position: relative;
            display: inline-block;
        }
        
        .user-dropdown {
            display: none;
            position: absolute;
            background: white;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            border-radius: 5px;
            overflow: hidden;
            right: 0;
            top: 100%;
        }
        
        .user-dropdown a {
            color: #333;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
            transition: background-color 0.3s;
        }
        
        .user-dropdown a:hover {
            background-color: #f1f1f1;
        }
        
        .user-menu:hover .user-dropdown {
            display: block;
        }
    </style>
</head>
<body>
    <!-- Navbar 20% maior com novos links -->
    <nav class="navbar">
        <div class="logo-container">
            <div class="logo">
                Logo
            </div>
        </div>
        
        <div class="search-container">
            <input type="text" 
                   class="search-bar" 
                   placeholder="Pesquisar no portal...">
        </div>
        
        <div class="nav-links">
            <?php if(isset($_SESSION['logado']) && $_SESSION['logado']): ?>
                <!-- Menu do usuário logado -->
                <div class="user-menu">
                    <a href="#"><i class="fas fa-user"></i> <span><?php echo explode(' ', $_SESSION['usuario_nome'])[0]; ?></span> <i class="fas fa-caret-down"></i></a>
                    <div class="user-dropdown">
                        <a href="#"><i class="fas fa-user-circle"></i> Meu Perfil</a>
                        <a href="#"><i class="fas fa-cog"></i> Configurações</a>
                        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Sair</a>
                    </div>
                </div>
            <?php else: ?>
                <!-- Links para usuários não logados -->
                <a href="cadastro.php"><i class="fas fa-user"></i> <span>Cadastrar</span></a>
                <a href="login.php"><i class="fas fa-user"></i> <span>Login</span></a>
            <?php endif; ?>
            
            <a href="#"><i class="fas fa-compass"></i> <span>Explorar</span></a>
            <a href="#"><i class="fas fa-users"></i> <span>Comunidade</span></a>
            <a href="#"><i class="fas fa-users"></i> <span>criar</span></a>
            <a href="sobre.php"><i class="fas fa-info-circle"></i> <span>Sobre</span></a>
        </div>
    </nav>

    <!-- Conteúdo da página principal aqui -->
    
    <!-- Footer -->
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
