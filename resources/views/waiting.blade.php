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
    <div id="response">
        <ul>
            <li>Percentage: <strong class="conversion_status conversion_percentage" ></strong></li>
            <li>Per Convert: <strong class="conversion_status conversion_per_convert" ></strong></li>
            <li>Success: <strong class="conversion_status conversion_success" ></strong></li>
            <li>Errors: <strong class="conversion_status conversion_errors" ></strong></li>
        </ul>
    </div>
</body>
<script src="{{ asset('assets/js/app.min.js') }}"></script>
</html>