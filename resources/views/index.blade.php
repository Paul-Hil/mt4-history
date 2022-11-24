<x-header :data=$data></x-header>
    <main>
        <h3 style="text-align:center;">{{$data['year']}}</h3>

        <div class="tradesList_month-6">
            <x-card-month :data=$data :firstPart=true></x-card-month>
        </div>

        <div class="tradesList_month-12">
            <x-card-month :data=$data :firstPart=false></x-card-month>
        </div>


        @if($errors->any())
            <h5 style="text-align:center;">{{$errors->first()}}</h5>
        @endif
    </main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>