<!DOCTYPE html>
<html>
<head>
    <title>Calculadora de Salário</title>
    <style>
        /* Estilos para centralizar a div na página */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            width: 50%;
            text-align: center;
        }
        table {
            margin: 0 auto; /* Centraliza a tabela dentro da div */
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Calculadora de Salário</h2>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="vendas_semanais">Valor das vendas semanais:</label>
        <input type="text" name="vendas_semanais" id="vendas_semanais">
        <input type="submit" name="submit" value="Calcular">
    </form>

    <?php
    // Definição das constantes com os novos valores do Piso Regional do Paraná
    define('SALARIO_MINIMO_PR', 1856.94); // Novo salário mínimo regional do Paraná
    define('META_SEMANAL', 20000); // Meta de vendas semanal
    define('META_MENSAL', 80000); // Meta de vendas mensal

    // Função para calcular o salário final de um(a) vendedor(a) com base nas novas regras do Piso Regional do Paraná
    function calcularSalario($vendas_semanais) {
        // Verifica se as vendas semanais atingiram a meta
        if ($vendas_semanais >= META_SEMANAL) {
            // Calcula o excedente das vendas semanais em relação à meta
            $excedente_semanal = $vendas_semanais - META_SEMANAL;

            // Calcula o bônus do cumprimento da meta semanal (1% do valor da meta semanal)
            $bonus_meta_semanal = 0.01 * META_SEMANAL;

            // Calcula o bônus do excedente das vendas semanais (5% do excedente)
            $bonus_excedente_semanal = 0.05 * $excedente_semanal;

            // Verifica se as vendas mensais também atingiram a meta
            if ($vendas_semanais * 4 >= META_MENSAL) {
                // Calcula o excedente das vendas mensais em relação à meta
                $excedente_mensal = $vendas_semanais * 4 - META_MENSAL;

                // Calcula o bônus do excedente das vendas mensais (10% do excedente)
                $bonus_excedente_mensal = 0.10 * $excedente_mensal;

                // Calcula o salário final considerando o salário mínimo regional do Paraná
                $salario_final = SALARIO_MINIMO_PR + $bonus_meta_semanal + $bonus_excedente_semanal + $bonus_excedente_mensal;
            } else {
                // Calcula o salário final sem o bônus do excedente mensal
                $salario_final = SALARIO_MINIMO_PR + $bonus_meta_semanal + $bonus_excedente_semanal;
            }
        } else {
            // Se as vendas semanais não atingiram a meta, o vendedor recebe apenas o salário mínimo regional do Paraná
            $salario_final = SALARIO_MINIMO_PR;
        }

        // Retorna o salário final
        return $salario_final;
    }

    // Verifica se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verifica se o campo de vendas semanais foi preenchido
        if (!empty($_POST["vendas_semanais"])) {
            // Obtém o valor das vendas semanais do formulário
            $vendas_semanais = $_POST["vendas_semanais"];

            // Calcula o salário final com base no valor das vendas semanais
            $salario = calcularSalario($vendas_semanais);

            // Exibe o resultado em formato de tabela
            echo "<h3>Resultado:</h3>";
            echo "<table border='1'>";
            echo "<tr><th>Vendas Semanais</th><th>Salário Mínimo Regional</th><th>Meta Semanal</th><th>Meta Mensal</th><th>Salário Final</th></tr>";
            echo "<tr><td>$vendas_semanais</td><td>R$ " . number_format(SALARIO_MINIMO_PR, 2, ',', '.') . "</td><td>R$ " . number_format(META_SEMANAL, 2, ',', '.') . "</td><td>R$ " . number_format(META_MENSAL, 2, ',', '.') . "</td><td>R$ " . number_format($salario, 2, ',', '.') . "</td></tr>";
            echo "</table>";
        } else {
            // Se o campo de vendas semanais estiver vazio, exibe uma mensagem de erro
            echo "<p>Por favor, preencha o valor das vendas semanais.</p>";
        }
    }
    ?>

</div>

</body>
</html>