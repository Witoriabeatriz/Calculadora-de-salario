<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Salário</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Your CSS styles */
    </style>
</head>
<body>
    <div class="imagem">
        <img src="logos.jpg" alt="Notebook">
    </div>
    <h2>Calculadora de Salário</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="nome">Nome do Funcionário:</label><br>
        <input type="text" id="nome" name="nome" required><br><br>
       
        <label for="semana1">Venda Semanal (Semana 1):</label><br>
        <input type="number" id="semana1" name="semana1" required><br><br>
       
        <label for="semana2">Venda Semanal (Semana 2):</label><br>
        <input type="number" id="semana2" name="semana2" required><br><br>
       
        <label for="semana3">Venda Semanal (Semana 3):</label><br>
        <input type="number" id="semana3" name="semana3" required><br><br>
       
        <label for="semana4">Venda Semanal (Semana 4):</label><br>
        <input type="number" id="semana4" name="semana4" required><br><br>
       
        <label for="total_mes">Total de Vendas no Mês:</label><br>
        <input type="number" id="total_mes" name="total_mes" required><br><br>
       
        <input type="submit" value="Calcular Salário">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verifica se todos os campos foram preenchidos
        if (isset($_POST['nome'], $_POST['semana1'], $_POST['semana2'], $_POST['semana3'], $_POST['semana4'], $_POST['total_mes'])) {
            // Recebendo os dados do formulário
            $nome = htmlspecialchars($_POST['nome']);
            $semana1 = $_POST['semana1'];
            $semana2 = $_POST['semana2'];
            $semana3 = $_POST['semana3'];
            $semana4 = $_POST['semana4'];
            $total_mes = $_POST['total_mes'];
            
            // Definindo os valores e percentuais
            $salario_minimo = 1856.94;
            $meta_semanal = 20000; // Meta semanal
            $meta_mensal = 80000; // Meta mensal
            
            // Inicializando as bonificações
            $bonificacao_semanal = 0;
            $bonificacao_mensal = 0;
            
            // Calculando a bonificação sobre o valor das vendas de cada semana
            if (($semana1 >= $meta_semanal) && ($semana2 >= $meta_semanal) && ($semana3 >= $meta_semanal) && ($semana4 >= $meta_semanal)) {
                $bonificacao_semanal = ($semana1 + $semana2 + $semana3 + $semana4) * 0.05;
            }
            
            // Calculando a bonificação sobre o valor total de vendas no mês
            if ($total_mes >= $meta_mensal) {
                $bonificacao_mensal = $total_mes * 0.1;
            }

            // Calculating the salary
            $salario = $salario_minimo + $bonificacao_semanal + $bonificacao_mensal;

            // Displaying the result
            echo "<div class='result'>";
            echo "<h3>Resultado:</h3>";
            echo "<p>Nome do Funcionário: $nome</p>";
            echo "<p>Salário: R$ $salario</p>";
            echo "</div>";
        }
    }
    ?>
</body>
</html>
