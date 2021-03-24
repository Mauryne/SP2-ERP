<?php

namespace App\Http\Livewire;

use App\Models\Purchase;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Statistics extends Component
{
    public function render()
    {
        $months = array(
            1 => 'Janvier',
            2 => 'Février',
            3 => 'Mars',
            4 => 'Avril',
            5 => 'Mai',
            6 => 'Juin',
            7 => 'Juillet',
            8 => 'Août',
            9 => 'Septembre',
            10 => 'Octobre',
            11 => 'Novembre',
            12 => 'Décembre');

        // Affichage du mois + année dans le graphique en fonction du select
        $m = 'Mai';
        $mm = '05';
        $y = 2015;

        // Affichage des années
        $yearSales = json_decode(json_encode(DB::select("SELECT DISTINCT YEAR(date) AS year FROM sales GROUP BY YEAR(date)"), true));
        $yearPurchases = json_decode(json_encode(DB::select("SELECT DISTINCT YEAR(date) AS year FROM purchases GROUP BY YEAR(date)"), true));
        $years = [];

        for ($i = 0; $i <= count($yearSales) - 1; $i++) {
            $years[] += $yearSales[$i]->{'year'};
        }

        for ($i = 0; $i <= count($yearPurchases) - 1; $i++) {
            $years[] += $yearPurchases[$i]->{'year'};
        }

        $allYears = array_unique($years);
        asort($allYears);

        // Récupérer les prix en fonction de la date (mois + année)
        $sales = DB::select("SELECT * FROM sales WHERE date LIKE '".$y."-".$mm."%'");
        $purchases = DB::select("SELECT * FROM purchases WHERE date LIKE '".$y."-".$mm."%'");

        $allPurchases = Purchase::all()
            ->sum('price');

        $allSales = Sale::all()
            ->sum('price');

        $result = $allPurchases - $allSales;

        return view('livewire.statistics', [
            'months' => $months,
            'm' => $m,
            'sales' => $sales,
            'purchases' => $purchases,
            'allSales' => $allSales,
            'allPurchases' => $allPurchases,
            'result' => $result,
            'years' => $allYears,
            'années' => 2015,
        ]);
    }
}
