<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/bootstrap/dist/css/bootstrap.min.css') }}">
    <script src="{{ asset('vendor/adminlte/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
</head>
<body>

    <div class="row-fluid">

        <div class="col-md-12">
            <div class="jumbotron text-center">
                <div class="container-fluid">
                    <div>
                        <h3 class="display-4">Internal Server Error 500</h3>
                        <p class="lead">Desculpe! Tivemos um problema enquanto processavamos sua requisição.</p>
                        <button class="btn btn-primary" onclick="window.history.go(-1); return false;" role="button">Voltar</button>
                        <button class="btn btn-success" onclick="window.location.reload()" role="button">Tentar Novamente</button>
                    </div>
                    <br>
                    <div>
                        <img class="img-fluid" src="{{URL::asset('img/HTTP-Erro-500-1280x720.png')}}"/>
                    </div>


                </div>
            </div>

        </div>

    </div>


</body>
</html>
