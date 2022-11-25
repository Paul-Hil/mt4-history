<x-header :data=$data></x-header>
    <main>
        <h3 class="titre_header" style="text-align:center;display:block">{{$data['year']}}</h3>

        <div class="tradesList_month-6">
            <x-card-month :data=$data :firstPart=true></x-card-month>
        </div>

        <div class="tradesList_month-12">
            <x-card-month :data=$data :firstPart=false></x-card-month>
        </div>


        @if($errors->any())
            <h5 style="text-align:center;">{{$errors->first()}}</h5>
        @endif

        <div class="trades_open">
            <h3>Trades ouvert:</h3>

            @if(!empty($data['trades_open']))
                    <table>
                        <thead>
                            <tr style="background-color: white;">
                                <td>
                                    Heure
                                </td>

                                <td>
                                    Profit actuel
                                </td>

                                <td>
                                    Type
                                </td>

                                <td>
                                    Levier
                                </td>
                            </tr>
                        </thead>

                    @foreach($data['trades_open'] as $trades)
                        <tr>
                            <td>
                                {{$trades['openTime']}}
                            </td>

                            @if($trades['profit'] > 0)
                                <td class="profit_positive">
                                    +{{$trades['profit']}}€
                                </td>
                            @else
                                <td class="profit_negative">
                                    {{$trades['profit']}}€
                                </td>
                            @endif

                            @if($trades['type'] === 'buy')
                                <td class="type_buy">
                            @else
                                <td class="type_sell">
                            @endif
                                {{$trades['type']}}
                            </td>

                            <td>
                                {{$trades['levier']}}
                            </td>
                        </tr>
                    @endforeach

                    </table>
            @else
                <h4 style="text-align:center;">- Aucun trade en cours -</h4>
            @endif
        </div>
    </main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>