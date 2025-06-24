
<?php
header('Content-Type: application/json');

// Configurações do banco de dados
$host = 'localhost';
$dbname = 'cadastro_cliente';
$username = 'root'; // Substitua pelo seu usuário
$password = 'mysql2024';     // Substitua pela sua senha

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao conectar ao banco de dados']);
    exit;
}

// Recebe os dados do corpo da requisição
$dados = json_decode(file_get_contents('php://input'), true);

// Validação básica
if (empty($dados['nome']) || empty($dados['email']) || empty($dados['senha'])) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Todos os campos são obrigatórios.']);
    exit;
}

// Criptografa a senha
$senhaHash = password_hash($dados['senha'], PASSWORD_DEFAULT);

// Prepara a query SQL
$sql = "INSERT INTO cadastro (nome_completo, email, senha) VALUES (:nome, :email, :senha)";
$stmt = $pdo->prepare($sql);

// Tenta inserir
try {
    $stmt->execute([
        ':nome' => $dados['nome'],
        ':email' => $dados['email'],
        ':senha' => $senhaHash
    ]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(['status' => 'sucesso', 'mensagem' => 'Cadastro realizado com sucesso!']);
    } else {
        echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao cadastrar.']);
    }
} catch (PDOException $e) {
    // Verifica se o erro é por email duplicado
    if ($e->errorInfo[1] == 1062) {
        echo json_encode(['status' => 'erro', 'mensagem' => 'Este e-mail já está cadastrado.']);
    } else {
        echo json_encode(['status' => 'erro', 'mensagem' => 'Erro no banco de dados: ' . $e->getMessage()]);
    }
}
?>
