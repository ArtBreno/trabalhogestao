
<?php
session_start();
header('Content-Type: application/json');

// Configurações do banco de dados (mesmas do insert_cadastro.php)
$host = 'localhost';
$dbname = 'cadastro_cliente';
$username = 'root';
$password = 'mysql2024';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao conectar ao banco de dados']);
    exit;
}

$dados = json_decode(file_get_contents('php://input'), true);

if (empty($dados['email']) || empty($dados['senha'])) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Preencha todos os campos.']);
    exit;
}

$email = $dados['email'];
$senha = $dados['senha'];

// Buscar usuário no banco de dados
$sql = "SELECT id, nome_completo, senha FROM cadastro WHERE email = :email";
$stmt = $pdo->prepare($sql);
$stmt->execute([':email' => $email]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'E-mail não cadastrado.']);
    exit;
}

// Verificar senha
if (password_verify($senha, $usuario['senha'])) {
    // Login bem-sucedido - criar sessão
    $_SESSION['usuario_id'] = $usuario['id'];
    $_SESSION['usuario_nome'] = $usuario['nome_completo'];
    $_SESSION['usuario_email'] = $email;
    $_SESSION['logado'] = true;
    
    echo json_encode(['status' => 'sucesso', 'mensagem' => 'Login realizado com sucesso!']);
} else {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Senha incorreta.']);
}
?>
