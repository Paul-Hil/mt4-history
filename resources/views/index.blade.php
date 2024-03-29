<x-header :data=$data></x-header>
    <main>
        <div id="years_selected">
            <a href="/?year={{$data['year'] - 1}}">
                <img src="/assets/images/left-arrow.png">
            </a>

            <h3 class="titre_header" style="text-align:center;margin:0 45px;color:white;">{{$data['year']}}</h3>

            <a href="/?year={{$data['year'] + 1}}">
                <img src="/assets/images/right-arrow.png">
            </a>
        </div>

        <div id="tradesList">
            <div class="tradesList_month-6">
                <x-card-month :data=$data :firstPart=true></x-card-month>
            </div>

            <div class="tradesList_month-12">
                <x-card-month :data=$data :firstPart=false></x-card-month>
            </div>
        </div>

        @if($errors->any())
            <h5 style="text-align:center;color:white">{{$errors->first()}}</h5>
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
                                "interval": "15",
                                "timezone": "Europe/Paris",
                                "theme": "dark",
                                "style": "1",
                                "locale": "fr",
                                "toolbar_bg": "#f1f3f6",
                                "enable_publishing": false,
                                "hide_top_toolbar": true,
                                "save_image": false,
                                "container_id": "tradingview_f7cd1"
                                }
                            );
                    </script>
            </div>
            <!-- TradingView Widget END -->

            <div id="trades_infos">
                @if(!empty($data['trades_open']))

                <div class="trades_open">
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;">
                        <h3>Trades ouvert:</h3>

                        @if(count($data['trades_open']) > 1)
                            <span id="tradeOpen_total">Total:

                                @if($data['profit_tradesOpen'] > 0)
                                <span class="profit_positive">+
                                @else
                                <span class="profit_negative">
                                @endif
                                {{$data['profit_tradesOpen']}}€</span>
                            </span>
                        @endif

                    </div>
                        <table style="width: 100%;">
                            <thead>
                                <tr style="background-color: white;">
                                    <td>
                                        Heure
                                    </td>

                                    <td>
                                        Prix
                                    </td>

                                    <td>
                                        Profit actuel
                                    </td>

                                    <td>
                                        Type
                                    </td>
                                </tr>
                            </thead>

                        @foreach($data['trades_open'] as $trades)
                            <tr>
                                <td>
                                    {{$trades['openTime']}}
                                </td>

                                <td>
                                    {{$trades['price']}}
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
                            </tr>
                        @endforeach
                        </table>
                </div>
                @endif

                <div class="trades_close">
                    <h3>Historique:</h3>

                    @if(!empty($data['trades_close']))
                    <table>
                                <thead>
                                    <tr style="background-color:white;">
                                        <td>
                                            Date
                                        </td>

                                        <td>
                                            Open trade
                                        </td>

                                        <td>
                                            Close trade
                                        </td>

                                        <td>
                                            Profit
                                        </td>

                                        <td>
                                            Type
                                        </td>
                                    <tr>
                                </thead>

                    @foreach($data['trades_close'] as $trade)
                                <tr>
                                    <td>
                                        {{$trade['date']}}
                                    </td>

                                    <td>
                                        {{$trade['openTime']}}
                                    </td>

                                    <td>
                                        {{$trade['closeTime']}}
                                    </td>

                                    @if($trade['profit'] > 0)
                                        <td class="profit_positive">
                                            +{{$trade['profit']}}€
                                        </td>
                                    @else
                                        <td class="profit_negative">
                                            {{$trade['profit']}}€
                                        </td>
                                    @endif

                                    @if($trade['type'] === "buy")
                                        <td class='type_buy'>
                                    @else
                                        <td class='type_sell'>
                                    @endif
                                        {{$trade['type']}}
                                    </td>
                                </tr>
                    @endforeach
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

<script>
window.addEventListener("DOMContentLoaded", (event) => {
    setTimeout(() => {
        document.querySelector('h5').style.display = "none";
    }, "3000");
});
</script>
</body>
</html>
