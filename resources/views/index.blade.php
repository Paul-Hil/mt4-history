<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MT4 - History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
    <div class="accordion" style="width:50%" id="accordionExample"> 

        @foreach($data as $date => $tradeByDay)
        
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#date_{{$date}}" aria-expanded="true" aria-controls="collapseOne">
                    {{ strftime("%B %d %Y", strtotime($date)); }}  | Profit : +{{$tradeByDay[count($tradeByDay) - 1]}}
                </button>
            </h2>

            <div id="date_{{$date}}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <table>

                    @foreach($tradeByDay as $key => $trade)
                        @if((count($tradeByDay) - 1) !== $key)
                            <tr><td>{{$trade}}</td></tr>
                        @endif
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



