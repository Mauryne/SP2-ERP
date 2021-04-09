<?php

namespace App\Http\Livewire;

use App\Models\Purchase;
use App\Models\Sale;
use DateTime;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Statistics extends Component
{
    // Variables qui changent en fonction des choix de l'utilisateur
    public $monthLetter = '';
    public $monthFigure = '';
    public $year = '';
    //
    public $yearSales = '';
    public $yearPurchases = '';
    public $allYears = '';
    public $sales = '';
    public $purchases = '';
    public $allPurchases = '';
    public $allSales = '';
    public $result = '';
    public $allMonths = '';
    public $nextYears = '';
    public $years = '';

    public function __construct()
    {
        setlocale(LC_TIME, "fr_FR", "French");
        $monthLetter = ucwords(strftime("%B"));
        $year = strftime("%G");
        $nextYears = $year - 10;
        $years = array();
        while($year >= $nextYears)
        {
            $years[] += $nextYears;
            $nextYears = $nextYears + 1;
        }
        $this->monthLetter = $monthLetter;
        $this->year = $year;
        $this->nextYears = $nextYears;
        $this->years = $years;
    }

    public function mount()
    {
        $this->monthFigure = $this->setMonthFigure($this->monthLetter);
    }

    public function showMonths()
    {
        $this->allMonths = array(
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

        return $this->allMonths;
    }

    public function setMonthFigure($monthLetter)
    {
        $allMonths = $this->showMonths();
        foreach ($allMonths as $value => $oneMonth) {
            if ($oneMonth == $monthLetter) {
                if($value < 10) {
                    $this->monthFigure = 0 . $value;
                } else {
                    $this->monthFigure = $value;
                }
            }
        }
        return $this->monthFigure;
    }

    public function showYears()
    {
        $this->yearSales = DB::select("SELECT DISTINCT YEAR(date) AS year FROM sales GROUP BY YEAR(date)");
        $this->yearPurchases = DB::select("SELECT DISTINCT YEAR(date) AS year FROM purchases GROUP BY YEAR(date)");
        $years = [];

        for ($i = 0; $i <= count($this->yearSales) - 1; $i++) {
            $years[] += $this->yearSales[$i]->year;
        }

        for ($i = 0; $i <= count($this->yearPurchases) - 1; $i++) {
            $years[] += $this->yearPurchases[$i]->year;
        }


        $this->allYears = array_unique($years);
        asort($this->allYears);
        //dd($this->allYears);
    }


    public function showPrice()
    {
        $this->setMonthFigure($this->monthLetter);

        // Récupérer les prix en fonction de la date (mois + année)
        $this->sales = DB::select("SELECT * FROM sales WHERE date LIKE '" . $this->year . "-" . $this->monthFigure . "%'");
        $this->purchases = DB::select("SELECT * FROM purchases WHERE date LIKE '" . $this->year . "-" . $this->monthFigure . "%'");

        $this->allPurchases = DB::select("SELECT SUM(price) AS price FROM purchases WHERE date LIKE '" . $this->year . "-" . $this->monthFigure . "%'");

        $this->allSales = DB::select("SELECT SUM(price) AS price FROM sales WHERE date LIKE '" . $this->year . "-" . $this->monthFigure . "%'");

        $this->result = (float)$this->allSales[0]->price - (float)$this->allPurchases[0]->price;
    }

    public function render()
    {
        //$this->showYears();
        $this->showMonths();
        $this->showPrice();

        return view('livewire.statistics', [
            'allMonths' => $this->allMonths,
            'monthLetter' => $this->monthLetter,
            'allYears' => $this->allYears,
            'year' => $this->year,
            'nextYears' => $this->nextYears,
            'years' => $this->years,
            'sales' => $this->sales,
            'purchases' => $this->purchases,
            'allSales' => $this->allSales,
            'allPurchases' => $this->allPurchases,
            'result' => $this->result,
        ]);
    }
}
