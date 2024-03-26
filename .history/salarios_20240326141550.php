<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Salário</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #003664;
            color: #ffffff;
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        h2 {
            text-align: center;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #002147;
            padding: 20px;
            border-radius: 10px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #ffffff;
        }

        input[type="text"],
        input[type="number"],
        input[type="submit"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: none;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .result {
            background-color: #002147;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            color: #ffffff;
        }

        .result p {
            margin: 0;
        }
    </style>
</head>
<body>
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
            $nome = $_POST['nome'];
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
            $vendas_semanais = [$semana1, $semana2, $semana3, $semana4];
            foreach ($vendas_semanais as $venda_semanal) {
                if ($venda_semanal >= $meta_semanal) {
                    $bonificacao_semanal += ($venda_semanal - $meta_semanal) * 0.05; // Bonificação sobre o excedente
                    $bonificacao_semanal += $meta_semanal * 0.01; // Bonificação sobre a meta semanal
                }
            }
            
            // Verificando se a meta mensal foi atingida
            if (array_sum($vendas_semanais) >= $meta_mensal) {
                $excedente_mensal = array_sum($vendas_semanais) - $meta_mensal;
                $bonificacao_mensal = $excedente_mensal * 0.1; // Bonificação sobre o excedente de meta mensal
            }
            
            // Calculando o salário final
            $salario_final = $salario_minimo + $bonificacao_semanal + $bonificacao_mensal;
            
            // Exibindo o resultado
            echo "<div class='result'>";
            echo "<p>Nome do Funcionário: $nome</p>";
            echo "<p>Salário Final: R$ " . number_format($salario_final, 2) . "</p>";
            echo "</div>";
        }
    }
    ?>
</body>
</html>
