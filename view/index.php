<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta COVID-19</title>
    <style>
        /* Adicione estilos CSS conforme necessário */
    </style>
</head>
<body>
    <h1>Consulta COVID-19</h1>
    <form id="consultaForm" action=".././controller/consulta.php" method="GET">
        <label for="pais">Escolha o país:</label>
        <select name="pais" id="pais">
            <option value="Brazil">Brasil</option>
            <option value="Canada">Canadá</option>
            <option value="Australia">Austrália</option>
        </select>
        <button type="submit">Consultar</button>
    </form>

    <!-- Div para exibir a data e país do último acesso -->
    <div id="ultimoAcesso"></div>

    <script>
        // JavaScript para obter a data e país do último acesso
        fetch('../controller/ultimo_acesso.php')
            .then(response => response.text())
            .then(data => {
                document.getElementById('ultimoAcesso').innerHTML = data;
            });
    </script>
</body>
</html>