<!-- resources/views/estados/index.blade.php -->
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Estados</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1>Lista de Estados - BRASIL API</h1>
        @if ($errorMessage)
            <div class="alert alert-danger">

                {{ $errorMessage }}

            </div>
        @else
            <ul class="list-group">
                @foreach ($estados as $estado)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $estado['nome'] }}
                        <a href="{{ url('/brasilapi/municipios/' . $estado['sigla']) }}"
                            class="btn btn-primary btn-sm">Ver
                            Municípios</a>
                    </li>
                @endforeach
            </ul>
        @endif
        <a href="{{ url('/') }}" class="btn btn-primary mt-3">Voltar para início</a>
    </div>

</body>

</html>
