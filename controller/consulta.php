<?php

// include_once '/controller/ultimo_acesso.php';
// include_once '../view/index.php';

if(isset($_GET['pais'])){
    $pais = $_GET['pais'];
    var_dump($_GET);
    $url = "https://dev.kidopilabs.com.br/exercicio/covid.php?pais=$pais";
    $dados = file_get_contents($url);
    $dados_array = json_decode($dados, true);

    try {
        $host = "localhost";
        $user = "root";
        $db = "acessos_api";
        $pass = "";
        // Conectar ao banco de dados usando PDO
        $conexao = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        
        // Preparar a consulta para inserir dados de acesso
        $query = "INSERT INTO acessos_api (data_hora, pais_consultado) VALUES (:data_hora, :pais)";
        $stmt = $conexao->prepare($query);
        
        // Bind dos parâmetros
        $data_hora = date('Y-m-d H:i:s');
        $stmt->bindParam(':data_hora', $data_hora);
        $stmt->bindParam(':pais', $pais);
        
        // Executar a consulta
        $stmt->execute();

        // Exibir os dados da API conforme antes
        if(isset($dados_array[0]['ProvinciaEstado'])){
            // Exibir dados por estado
            foreach($dados_array as $estado){
                echo "<p>{$estado['ProvinciaEstado']} - Confirmados: {$estado['Confirmados']}, Mortos: {$estado['Mortos']}</p>";
            }
            echo "<a href='../view/index.php'>Back to home</a>";
            
            // header("Location: ../view/index.php");
            // echo $_GET['pais'];
        }else{
            // Exibir dados do país inteiro
            $total_confirmados = $dados_array['TotalConfirmados'] ?? 'N/A';
            $total_mortos = $dados_array['TotalMortos'] ?? 'N/A';
            echo "<p>Total Confirmados: $total_confirmados, Total Mortos: $total_mortos</p>";
        }

        // Fechar a conexão
        $conexao = null;
    } catch(PDOException $e) {
        echo "Erro ao inserir dados: " . $e->getMessage();
    }
} elseif(!isset($_GET['pais'])) {
    echo 'Erro: País não foi selecionado. <br>';
    // echo $_GET['pais'];
}