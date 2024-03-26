<!DOCTYPE html>
<html>
<head>
    <title>Calculadora de Salário</title>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous">
    <script src='Login.js'></script>
    <link rel="stylesheet" href="Campeonato.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: linear-gradient(to bottom right, #FFD8E2, #B0E0E6);
        }

        .imagem {
            background-color: #003664;
            text-align: center;
        }

        img {
            width: 400px;
            margin: auto;
            display: block;
        }

        .container {
            width: 50%;
            text-align: center;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
        }

        label {
            color: #ffffff;
            font-size: 20px;
            font-weight: 600;
            line-height: 1.5;
        }

        table {
            width: 100%;
        }
    </style>
</head>
<body>

<div class="imagem">
    <br>
    <img src="logos.jpg" alt="Notbook">
</div>
<div class="container">
    <br>
    <label id="Nome">Nome do vendedor:</label>
    <input class="form-control" id="Participantes" type="text">
    <br><br>
    <label id="MetaSemanal">Meta Semanal:</label>
    <input class="form-control" id="MetaSemanalInput" type="number">
    <br><br>
    <label id="MetaMensal">Meta Mensal:</label>
    <input class="form-control" id="MetaMensalInput" type="number">
    <br><br>
    <!--<input class="form-control" id="Sexo" type="text"> -->
    <button class="btn btn-primary" type="button" onclick="salvarUser()">Salvar</button>
    <br><br>
</div> <br>
<div class="container">
    <table class="table table-striped" id="tabela">
        <tr>
            <th>Nome do vendedor</th>
            <th>Meta Semanal</th>
            <th>Meta Mensal</th>
            <th>Ações</th>
        </tr>
    </table>
</div>

</body>
</html>
