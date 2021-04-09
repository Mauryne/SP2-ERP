<div class="container-fluid ml-7 mt-4">
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
                            <select wire:model.lazy="year" id="year" class="custom-select form-select-sm">
                                <?php
                                $year = date("Y");
                                $nextYears = $year - 10;

                                for ($i = $year; $i >= $nextYears; $i--) {
                                    echo '<option value="' . $i . '">' . $i . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-auto mt-3">
                            <h4>Mois :</h4>
                        </div>

                        <div class="col-md-2">
                            <select wire:model.lazy="monthLetter" id="month" class="custom-select form-select-sm">
                                @foreach($allMonths as $oneMonth)
                                    <option value="{{ $oneMonth }}">{{ $oneMonth }}</option>
                                @endforeach
                            </select>
                        </div>
{{--                        <button onclick="updateChart()" class="btn btn-secondary">Sélectionner</button>--}}
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="col-auto float-left w-75">
                        <canvas id="salesChart" class="chart-canvas"></canvas>
                    </div>
                    <div class="mt-5" style="text-align: center">
                        <label style="text-align: center"><B> {{ $monthLetter }} {{ $year }}</B></label>
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
        let purchases = {!! json_encode($purchases) !!}
        purchases.forEach(purchase =>
            purchasesPrices.push(purchase["price"]),
        );

        let salesPrices = [];
        let sales = {!! json_encode($sales) !!}
        sales.forEach(sale =>
            salesPrices.push(sale["price"]),
        );

        function getMonth() {
            return document.getElementById('month').options[document.getElementById('month').selectedIndex].innerHTML;
        }

        function getYear() {
            return document.getElementById('year').options[document.getElementById('year').selectedIndex].innerHTML;
        }

        //let m = {!! json_encode($monthLetter) !!};
        m = getMonth();
        m += ' ';
        m += getYear();

        {{--new Chart('salesChart', {--}}
        {{--    type: 'bar',--}}
        {{--    options: {--}}
        {{--        scales: {--}}
        {{--            yAxes: [{--}}
        {{--                ticks: {--}}
        {{--                    callback: function (value) {--}}
        {{--                        return value + '€';--}}
        {{--                    }--}}
        {{--                }--}}
        {{--            }]--}}
        {{--        }--}}
        {{--    },--}}
        {{--    data: {--}}
        {{--        labels: [m],--}}
        {{--        datasets: [{--}}
        {{--            label: 'Achats',--}}
        {{--            data: purchasesPrices,--}}
        {{--            backgroundColor: '#7687A3',--}}
        {{--            borderColor: '#7687A3',--}}
        {{--        }, {--}}
        {{--            label: 'Ventes',--}}
        {{--            data: salesPrices,--}}
        {{--            backgroundColor: '#A8C5E1',--}}
        {{--            borderColor: '#A8C5E1',--}}
        {{--        }]--}}
        {{--    },--}}
        {{--});--}}

        // var olddata = [0, 10, 5, 2, 20, 30, 45];
        // var newdata = [10, 20, 30, 40, 50, 60, 70];
        // var olddata1 = [1, 4, 5, 9, 8, 7, 2];
        // var newdata1 = [30, 40, 50, 60, 70, 80, 90];

        var ctx = document.getElementById('salesChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',

            data: {
                labels: [m],
                datasets: [{
                    label: 'Achats',
                    backgroundColor: '#7687A3',
                    borderColor: '#7687A3',
                    data: purchasesPrices
                }, {
                    label: 'Ventes',
                    backgroundColor: '#A8C5E1',
                    borderColor: '#A8C5E1',
                    data: salesPrices
                }]
            },

            options: {}
        });

        function updateChart() {
            chart.data.datasets[0].data = salesPrices;
            chart.data.datasets[1].data = purchasesPrices;
            chart.update();
        }

        // function addValue() {
        //     chart.data.datasets[0].data.shift();
        //     chart.data.labels.push("January");
        //     chart.update();
        // }

        // function showLabel() {
        //     var month = document.getElementById('month').value;
        //     var year = document.getElementById('year').value;
        //     var div = document.getElementById('label');
        //
        //     var label = document.createElement('label');
        //     label.setAttribute('style', 'text-align: center');
        //
        //     var text = document.createElement('B');
        //     text.textContent = month + ' ' + year;
        //
        //     label.appendChild(text);
        //     div.appendChild(label);
        //
        //     console.log(month, year, div)
        // }
    </script>
@endsection
