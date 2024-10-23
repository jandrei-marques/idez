<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Municípios</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1>Lista de Municípios - BRASIL API</h1>
        @if ($errorMessage)
            <div class="alert alert-danger">

                {{ $errorMessage }}

            </div>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Código IBGE</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($municipios as $municipio)
                        <tr>
                            <td>{{ $municipio['nome'] }}</td>
                            <td>{{ $municipio['codigo_ibge'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        <a href="{{ url('/brasilapi') }}" class="btn btn-primary mt-3">Voltar para Estados</a>
    </div>
</body>

</html>
