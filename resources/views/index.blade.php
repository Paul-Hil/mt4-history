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
            Profit:

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

    <div class="accordion" style="width:100%;margin:auto" id="accordionExample">

        @foreach($data['tradesByDays'] as $date => $tradesByDay)
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" style="background-color:#e7f1ff;padding:0;" type="button" data-bs-toggle="collapse" data-bs-target="#date_{{$date}}" aria-expanded="true" aria-controls="collapseOne">
                            <div class="accordion_tradeDay">
                                <div class="date">{{ $tradesByDay['label'] }}</div>

                                @if($tradesByDay['profit'] > 0)
                                    <div>Profit: <span class="profit_positive">+{{$tradesByDay['profit']}}€</div>
                                @else
                                    <div>Profit: <span class="profit_negative">{{$tradesByDay['profit']}}€<span></div>
                                @endif

                                <div>Commission: <span class="profit_negative">{{$tradesByDay['commission']}}0€<span></span></div>

                                @if($tradesByDay['profit'] > 0)
                                    <div>Profit total: <span class="profit_positive">+{{$tradesByDay['profit_total']}}€</span></div>
                                @else
                                    <div>Profit total: <span class="profit_negative">{{$tradesByDay['profit_total']}}€</span></div>
                                @endif
                            </div>
                    </button>
                </h2>


                <div id="date_{{$date}}" class="accordion-collapse collapse" aria-labelledby="headingOne">
                    <div class="accordion-body" style="background-color:azure">
                        <table>
                            <thead>
                                <tr style="background-color:white;">
                                    <td>
                                        Heure
                                    </td>

                                    <td>
                                        Profit
                                    </td>

                                    <td>
                                        Type
                                    </td>

                                    <td>
                                        Levier
                                    </td>
                                <tr>
                            </thead>


                        @foreach($tradesByDay['tradesList'] as $time => $trade)
                            <tr>
                                <td>
                                    {{$trade['dateTime']}}
                                </td>
                                @if($trade['profit'] > 0)
                                    <td class="profit_positive">
                                        +{{$trade['profit']}}
                                    </td>
                                @else
                                    <td class="profit_negative">
                                        {{$trade['profit']}}
                                    </td>
                                @endif

                                @if($trade['type'] === "buy")
                                    <td class='type_buy'>
                                @else
                                    <td class='type_sell'>
                                @endif
                                    {{$trade['type']}}
                                </td>

                                <td>
                                    {{$trade['levier']}}
                                </td>
                            </tr>
                        @endforeach
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>



