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

        @if(isset(explode('/', url()->current())[3]) && explode('/', url()->current())[3] === 'history')
            <a id="image_back" href="{{ route('index') }}">
                <img style="width: 46px;height: 46px;"src="/assets/images/2997013.png">
            </a>
        @else
            <a id="image_back" href="{{ route('historic') }}">
                <img style="width: 46px;height: 46px;"src="/assets/images/1213797.png">
            </a>
        @endif

        <div>
            {{$data['file_updated_at']}}
        </div>

        <div>
            Profit {{$data['year']}}:

            @if($data['profitYear'] > 0)
                <span style='color:green'> +{{$data['profitYear']}}€</span>
            @else
                <span style='color:red'> {{$data['profitYear']}}€</span>
            @endif
        </div>

        <div>
            Profit total:

            @if($data['profitTotal'] > 0)
                <span style='color:green'> +{{$data['profitTotal']}}€</span>
            @else
                <span style='color:red'> {{$data['profitTotal']}}€</span>
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
            Balance: {{$data['balance']}}€
        </div>

        <a href="/updateFileMT4">
            <img src="/assets/images/refresh-page-option.png">
        </a>
    </header>