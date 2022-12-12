<?php $count = 1;  ?>
    @foreach($data as $month => $infos)

        @if($firstPart && $count <= 6)
            <a href="/trades-by-days/{{$count}}/{{$data['year']}}">
                <div class="monthsList">
                    <h4 style="text-align: center;">{{$month}}</h4>

                    @if($infos['profitPerMonth'] > 0)
                        <div>Profit: <span class="profit_positive">+{{$infos['profitPerMonth']}}€</span></div>
                    @else
                        <div>Profit: <span class="profit_negative">{{$infos['profitPerMonth']}}€</span></div>
                    @endif

                    <div>Commission: <span class="profit_negative">-{{$infos['commission']}}€</span></div>
                </div>
            </a>
        @endif

        @if(!$firstPart && $count >= 7 && $count <= 12)
            <a href="/trades-by-days/{{$count}}/{{$data['year']}}">
                <div class="monthsList">
                    <h4 style="text-align: center;">{{$month}}</h4>

                    @if($infos['profitPerMonth'] > 0)
                        <div>Profit: <span class="profit_positive">+{{$infos['profitPerMonth']}}€</span></div>
                    @else
                        <div>Profit: <span class="profit_negative">{{$infos['profitPerMonth']}}€</span></div>
                    @endif

                    <div>Commission: <span class="profit_negative">-{{$infos['commission']}}€</span></div>
                </div>
            </a>
        @endif

        <?php $count++ ?>
    @endforeach
