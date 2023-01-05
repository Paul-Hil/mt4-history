<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MT4 - History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/app.css') }}">
    <link rel="icon" type="image/png" href="{{ URL::asset('assets/images/favmt4.png') }}" />
</head>

<body>
    <header>
        <a id="home" href="{{route('index')}}">
            <img src="/assets/images/home.png">
        </a>

        <a id="image_back" href="{{ url()->previous() }}">
            <img src="/assets/images/59098.png">
        </a>

        <div>
            {{$data['file_updated_at']}}
        </div>

        <div>
            Balance: {{$data['balance']}}€
        </div>

        <div>
            Profit 2023:

            @if($data['profit'] > 0)
                <span style='color:green'> +{{$data['profit']}}€</span>
            @else
                <span style='color:red'> {{$data['profit']}}€</span>
            @endif
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

        <a href="/updateFileMT4">
            <img src="/assets/images/refresh-page-option.png">
        </a>
    </header>
