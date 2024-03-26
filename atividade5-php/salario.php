<!DOCTYPE html>
<html>
<head>
    <title>Calculadora de Salário</title>
    <style>
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
            margin: 0 auto; 
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
    define('SALARIO_MINIMO_PR', 1856.94);
    define('META_SEMANAL', 20000); 
    define('META_MENSAL', 80000); 
    function calcularSalario($vendas_semanais) {
        if ($vendas_semanais >= META_SEMANAL) {
            $excedente_semanal = $vendas_semanais - META_SEMANAL;
            $bonus_meta_semanal = 0.01 * META_SEMANAL;
            $bonus_excedente_semanal = 0.05 * $excedente_semanal;
            if ($vendas_semanais * 4 >= META_MENSAL) {
                $excedente_mensal = $vendas_semanais * 4 - META_MENSAL;
                $bonus_excedente_mensal = 0.10 * $excedente_mensal;
                $salario_final = SALARIO_MINIMO_PR + $bonus_meta_semanal + $bonus_excedente_semanal + $bonus_excedente_mensal;
            } else {
                $salario_final = SALARIO_MINIMO_PR + $bonus_meta_semanal + $bonus_excedente_semanal;
            }
        } else {
            $salario_final = SALARIO_MINIMO_PR;
        }
        return $salario_final;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST["vendas_semanais"])) {
            $vendas_semanais = $_POST["vendas_semanais"];
            $salario = calcularSalario($vendas_semanais);
            echo "<h3>Resultado:</h3>";
            echo "<table border='1'>";
            echo "<tr><th>Vendas Semanais</th><th>Salário Mínimo Regional</th><th>Meta Semanal</th><th>Meta Mensal</th><th>Salário Final</th></tr>";
            echo "<tr><td>$vendas_semanais</td><td>R$ " . number_format(SALARIO_MINIMO_PR, 2, ',', '.') . "</td><td>R$ " . number_format(META_SEMANAL, 2, ',', '.') . "</td><td>R$ " . number_format(META_MENSAL, 2, ',', '.') . "</td><td>R$ " . number_format($salario, 2, ',', '.') . "</td></tr>";
            echo "</table>";
        } else {
            echo "<p>Por favor, preencha o valor das vendas semanais.</p>";
        }
    }
    ?>
</div>

</body>
</html>