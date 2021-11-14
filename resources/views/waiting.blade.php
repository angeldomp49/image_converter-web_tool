<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>waiting</title>
    <script>
        let makechtec = {
            imageConverter:{
                conversionDispatcherURL : "{{ route('prueba.ajax') }}"
            }
        };
    </script>
</head>
<body>
    <button id="check">check status</button>
    <br/>
    <div id="response"></div>
</body>
<script src="{{ asset('assets/js/app.min.js') }}"></script>
</html>