<?php

include_once './consulta.php';

try {
    // Conectar ao banco de dados usando PDO
    $conexao = new PDO('mysql:host=localhost;dbname=acessos_api', 'root', '');
    
    // Consulta para obter o último acesso
    $query = "SELECT data_hora, pais_consultado FROM acessos_api ORDER BY id DESC LIMIT 1";
    $stmt = $conexao->query($query);

    if($stmt){
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        if($resultado){
            echo "Último acesso em {$resultado['data_hora']} - País: {$resultado['pais_consultado']}";
        }else{
            echo "Nenhum acesso registrado.";
        }
    }else{
        echo "Erro ao consultar o banco de dados.";
    }

    // Fechar a conexão
    $conexao = null;
} catch(PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
}
?>