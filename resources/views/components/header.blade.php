<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MT4 - History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/app.css') }}">

</head>
<body>
    <header>
        <div>
            {{$data['account']}}
        </div>
        
        <div>
            Balance: {{$data['balance']}}€
        </div>

        <div>
            Profit total: 
            
            @if($data['profit'] > 0)
                <span style='color:green'> +{{$data['profit']}}€</span>
            @else
                <span style='color:red'> {{$data['profit']}}€</span>
            @endif
        </div>

        <div>
            Moyenne: 
            
            @if($data['average'] > 0)
                <span style='color:green'> +{{$data['average']}}€</span> /j
            @else
                <span style='color:red'> {{$data['average']}}€</span> /j
            @endif
        </div>

        <div>
            {{$data['file_updated_at']}}
        </div>

        <a id="image_refresh" href="/updateFileMT4">
            <img src="/assets/images/585e4831cb11b227491c338e.png">
        </a>
    </header>