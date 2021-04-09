<div class="container-fluid ml-7 mt-4 h-100">
    <div class="row justify-content-center">
        <div class="col-md-9 mt-4 ml-2">
            <!-- Card -->
            <div class="card card-fill">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <!-- Title -->
                            <h4 class="card-header-title ml-auto">
                                Statistiques
                            </h4>
                        </div>

                        <div class="col-auto mt-3 ml-auto">
                            <h4>Année :</h4>
                        </div>

                        <div class="col-md-2 ml-auto">
                            <select wire:model.lazy="year" onchange="getDate()" id="year"
                                    class="custom-select form-select-sm">
                                {{arsort($years)}}
                                @foreach($years as $oneYear)
                                    @if($oneYear == strftime("%G"))
                                        <option selected value="{{$oneYear}}">{{$oneYear}}</option>
                                    @else
                                        <option value="{{$oneYear}}">{{$oneYear}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="col-auto mt-3">
                            <h4>Mois :</h4>
                        </div>

                        <div class="col-md-2">
                            <select wire:model.lazy="monthLetter" onchange="getDate()" id="month"
                                    class="custom-select form-select-sm">
                                @foreach($allMonths as $oneMonth)
                                    @if($oneMonth == ucwords(strftime("%B")))
                                        <option selected value="{{ $oneMonth }}">{{ $oneMonth }}</option>
                                    @else
                                        <option value="{{ $oneMonth }}">{{ $oneMonth }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="container-fluid h-100">
                    <div id="chart" class="col-auto float-left w-75">
                        <canvas id="salesChart" class="chart-canvas"></canvas>
                    </div>
                    <div class="mt-5" style="text-align: center">
                        <label style="text-align: center"><B> {{ $monthLetter }} {{$year}}</B></label>
                    </div>
                    <div class="col-auto float-right w-25 mt-7" style="text-align: center">
                        <label style="text-align: center">Total des ventes :
                            <B>@isset($allSales){{ $allSales[0]->price }} € @endisset</B></label>
                        <br>
                        <label>Total des achats : <B>@isset($allPurchases){{ $allPurchases[0]->price }}
                                €@endisset</B></label>
                        <br>@isset($allSales, $allPurchases, $result)
                            @if($allSales[0]->price < $allPurchases[0]->price)
                                <label>Perte de <B>{{ $result }} € </B></label>
                            @else
                                <label>Bénéfice de <B>{{ $result }} € </B></label>
                            @endif
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('js')
    <script>
        let purchasesPrices = [];
        let purchases = {!! json_encode($allPurchases) !!}
        purchases.forEach(purchase =>
            purchasesPrices.push(purchase["price"]),
        );

        let salesPrices = [];
        let sales = {!! json_encode($allSales) !!}
        sales.forEach(sale =>
            salesPrices.push(sale["price"]),
        );

        function getDate() {
            var a = document.getElementById('month').options[document.getElementById('month').selectedIndex].innerHTML;
            var b = document.getElementById('year').options[document.getElementById('year').selectedIndex].innerHTML;
            var m = a;
            m += ' ';
            m += b;
            return m;
        }

        Array.max = function (array) {
            return Math.max.apply(Math, array);
        };
        var biggestNumberPurchases = Array.max(purchasesPrices);
        var biggestNumberSales = Array.max(salesPrices);

        if (biggestNumberPurchases > biggestNumberSales) {
            biggestNumber = biggestNumberPurchases
        } else {
            biggestNumber = biggestNumberSales
        }

                var ctx = document.getElementById('salesChart').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'bar',

                    data: {
                        labels: [getDate()],
                        datasets: [{
                            label: 'Achats',
                            backgroundColor: '#7687A3',
                            borderColor: '#7687A3',
                            data: purchasesPrices,
                            pointRadius: 5,
                            pointHoverRadius: 10,
                            pointHitRadius: 30,
                        }, {
                            label: 'Ventes',
                            backgroundColor: '#A8C5E1',
                            borderColor: '#A8C5E1',
                            data: salesPrices,
                            pointRadius: 5,
                            pointHoverRadius: 10,
                            pointHitRadius: 30,
                        }]
                    },

                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    steps: 15,
                                    max: biggestNumber + 500,
                                }
                            }]
                        }
                    }
                });
    </script>
@endsection
