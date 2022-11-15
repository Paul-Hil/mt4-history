<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MT4 - History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">

</head>
<body>
    <div class="accordion" style="width:100%;margin:auto" id="accordionExample">

        @foreach($data as $date => $tradesByDay)
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#date_{{$date}}" aria-expanded="true" aria-controls="collapseOne">
                        <div style="display:flex;width:80%;justify-content:space-around;">
                            <div>{{ strftime("%d %B %Y", strtotime($date)); }}</div>
                            <div>Profit : +{{$tradesByDay['profit']}}€</div>
                            <div>Commission : {{$tradesByDay['commission']}}0€</div>
                            <div>Profil total : +{{$tradesByDay['profit_total']}}€</div>
                        </div>
                </button>
            </h2>

            <div id="date_{{$date}}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body" style="background-color:azure">
                    <table style="width:80%;margin:auto;border:solid 1px black;border-radius:20px">
                        <thead style="border: solid 1px black;">
                            <tr>
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
                                    Effet de levier
                                </td>
                            <tr>
                        </thead>
                    @foreach($tradesByDay['trades'] as $time => $trades)
                        @foreach($trades as $trade)

                        <tr>
                            <td>
                                {{$time}}
                            </td>

                            <td>
                                {{$trade}}€
                            </td>

                            <td>

                            </td>

                            <td>

                            </td>
                        </tr>
                        @endforeach
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



