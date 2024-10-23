<!DOCTYPE html>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escolha a API</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
</head>
<body>
    <div class="text-center">
        <h1>Escolha uma API para buscar os estados</h1>
        <p class="mt-3">Você pode utilizar a API do IBGE ou a Brasil API para obter informações sobre os estados e municípios. Selecione uma das opções abaixo:</p>
        <div class="mt-4">
            <a href="{{ url('/ibge') }}" class="btn btn-primary btn-lg mx-2">API do IBGE</a>
            <a href="{{ url('/brasilapi') }}" class="btn btn-success btn-lg mx-2">Brasil API</a>
        </div>
    </div>
</body>
</html>