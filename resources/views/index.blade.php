<x-header :data=$data></x-header>
    <main>
            <h3 class="titre_header" style="text-align:center;margin:0;color:white;">{{$data['year']}}</h3>
        <div id="tradesList">
            <div class="tradesList_month-6">
                <x-card-month :data=$data :firstPart=true></x-card-month>
            </div>

            <div class="tradesList_month-12">
                <x-card-month :data=$data :firstPart=false></x-card-month>
            </div>
        </div>

        @if($errors->any())
            <h5 style="text-align:center;">{{$errors->first()}}</h5>
        @endif

        <div id="section_infos">
            <!-- TradingView Widget BEGIN -->
            <div class="tradingview-widget-container">
                <div id="tradingview_f7cd1"></div>
                    <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                    <script type="text/javascript">
                        new TradingView.widget(
                                {
                                "autosize": true,
                                "symbol": "FOREXCOM:XAUUSD",
                                "interval": "30",
                                "timezone": "Europe/Paris",
                                "theme": "dark",
                                "style": "1",
                                "locale": "fr",
                                "toolbar_bg": "#f1f3f6",
                                "enable_publishing": false,
                                "hide_top_toolbar": true,
                                "allow_symbol_change": true,
                                "container_id": "tradingview_f7cd1"
                                }
                            );
                    </script>
            </div>
            <!-- TradingView Widget END -->
            <div style="height: 50%;">
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

                <div class="trades_close">
                    <h3>Trades de la journée:</h3>

                        <h4 style="text-align:center;">- Aucun trade -</h4>
                </div>
            </div>
        </div>
    </main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>
