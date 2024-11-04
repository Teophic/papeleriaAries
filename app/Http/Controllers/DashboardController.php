<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sells;
use Carbon\Carbon;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $todaySales = $this->getTodaySales();
        $monthlySales = $this->getMonthlySales();
        $yearSales = $this->getYearSales();

        return view('Menus.dashboard', [
            'todaySales' => $todaySales,
            'monthlySales' => $monthlySales,
            'yearSales' => $yearSales
        ]);
    }

    public function getTodaySales()
    {
        $today = Carbon::today();

        $sales = sells::whereDate('created_at', $today)->sum('preciototal');

        return $sales;
    }

    public function getMonthlySales()
    {
        $currentMonth = Carbon::now()->format('m');
        $currentYear = Carbon::now()->format('Y');

        $sales = sells::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->sum('preciototal');

        return $sales;
    }

    public function getYearSales()
    {
        $Sales = sells::selectRaw('MONTH(created_at) as mes, SUM(preciototal) as totalVentas')
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();

        // Crear un arreglo para llenar los meses faltantes (en caso de que algún mes no tenga ventas)
        $MonthSales = array_fill(1, 12, 0);
        foreach ($Sales as $Sale) {
            $MonthSales[$Sale->mes] = $Sale->totalVentas;
        }

        return $MonthSales;
    }
}
