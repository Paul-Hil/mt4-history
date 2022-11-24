<x-header :data=$data></x-header>
    <main>
        <div>
            <a id="image_back" href="{{route('index')}}">
                <img src="/assets/images/59098.png">
            </a>
            <h3 style="text-align:center">{{$data['date']}}</h3>
        </div>

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
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>



