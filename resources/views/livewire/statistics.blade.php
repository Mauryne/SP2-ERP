<div class="container-fluid ml-7 mt-4">
    <div class="row justify-content-center">
        <div class="col-md-9 mt-4 ml-2">
            <div class="card">
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
                                    <option onclick="getMonth()" value="{{ $oneMonth }}">{{ $oneMonth }}</option>
                                @endforeach
                            </select>
                        </div>
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

        //let m = {!! json_encode($monthLetter) !!};
        m = getMonth();

        new Chart('salesChart', {
            type: 'bar',
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            callback: function (value) {
                                return value + '€';
                            }
                        }
                    }]
                }
            },
            data: {
                labels: ['1er ' + m, '3 ' + m, '6 ' + m, '9 ' + m, '12 ' + m, '5 ' + m, '18 ' + m, '21 ' + m, '24 ' + m, '27 ' + m, '30 ' + m],
                datasets: [{
                    label: 'Achats',
                    data: purchasesPrices,
                    backgroundColor: '#7687A3',
                    borderColor: '#7687A3',
                }, {
                    label: 'Ventes',
                    data: salesPrices,
                    backgroundColor: '#A8C5E1',
                    borderColor: '#A8C5E1',
                }]
            },
        });

    </script>
@endsection
