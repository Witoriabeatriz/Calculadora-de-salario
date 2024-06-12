<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Calculadora de salário</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous">
    <link rel="stylesheet" href="">
    <style>
        body {
            background-color: #003664;
            color: #ffffff;
        }

        img {
            width: 400px;
            margin: auto;
            display: block;
        }

        .container {
            background-color: #003664;
            padding: 20px;
            border-radius: 5px;
            margin-top: 20px;
        }

        label {
            font-size: 20px;
            font-weight: 600;
            line-height: 1.5;
        }
        
        tr{
            background-color:white;
        }

    </style>
</head>

<body>
    <div class="imagem">
        <br>
        <img src="logos.jpg" alt="Notebook">
    </div>
    <div class="container">
        <br>
        <label id="Nome">Nome do vendedor:</label>
        <input class="form-control" id="nomeVendedor" type="text" maxlength="11">
        <br><br>
        <label id="metasSemanaisLabel">Metas semanais:</label>
        <input class="form-control" id="metasSemanaisInput" type="text" maxlength="11" oninput="formatarValor(this)">
        <br><br>
        <label id="metasMensaisLabel">Metas mensais:</label>
        <input class="form-control" id="metasMensaisInput" type="text" maxlength="11" oninput="formatarValor(this)">
        <br><br>
        <button class="btn btn-primary" type="button" onclick="salvarUser()">Salvar</button>
    </div> <br>
    <div class="container">
        <table class="table table-striped" id="tabela">
            <thead>
                <tr>
                    <th>Nome do vendedor</th>
                    <th>Metas semanais</th>
                    <th>Metas mensais</th>
                    <th>Salário</th>
                </tr>
            </thead>
            <tbody id="tabelaCorpo">
            </tbody>
        </table>
    </div>

    <script>
        var nome = [];
        var metasSemanais = [];
        var metasMensais = [];

        function salvarUser() {
            let nomeVendedor = document.getElementById("nomeVendedor").value;
            let metasSemanaisInput = document.getElementById("metasSemanaisInput").value.replace(/[^\d]/g, '');
            let metasMensaisInput = document.getElementById("metasMensaisInput").value.replace(/[^\d]/g, '');

            if (nomeVendedor && metasSemanaisInput && metasMensaisInput) {
                nome.push(nomeVendedor);
                metasSemanais.push(metasSemanaisInput);
                metasMensais.push(metasMensaisInput);
                crialista();
                document.getElementById("nomeVendedor").value = '';
                document.getElementById("metasSemanaisInput").value = '';
                document.getElementById("metasMensaisInput").value = '';
            } else {
                alert("Preencha todos os campos obrigatórios.");
            }
        }

        function crialista() {
            let tabela = "";
            for (let i = 0; i < nome.length; i++) {
                let salario = calcularSalario(metasSemanais[i], metasMensais[i]);
                salario = formatarValorMonetario(salario);
                tabela += "<tr><td>" + nome[i] + "</td><td>" + formatarValorMonetario(metasSemanais[i]) + "</td><td>" + formatarValorMonetario(metasMensais[i]) + "</td><td>" + salario + "</td></tr>";
            }
            document.getElementById('tabelaCorpo').innerHTML = tabela;
        }

        function calcularSalario(metasSemanais, metasMensais) {
            return parseFloat(metasSemanais) * 10 + parseFloat(metasMensais) * 50;
        }

        function formatarValor(input) {
            let valor = input.value.replace(/[^\d]/g, '');
            input.value = formatarValorMonetario(valor);
        }

        function formatarValorMonetario(valor) {
            valor = valor.toString();
            valor = "R$ " + valor.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            return valor;
        }
    </script>
</body>

</html>
