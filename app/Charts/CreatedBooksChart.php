<?php

namespace App\Charts;

use App\Models\Book;
use Illuminate\Support\Facades\DB;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class CreatedBooksChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {

        $currentYear = now()->format('Y');

        $months = Book::select(DB::raw('MONTH(created_at) as month'))
            ->whereYear('created_at', $currentYear)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();

        $data = [];
        $labels = [];

        foreach ($months as $month) {
            $bookCount = Book::whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $month->month)
                ->count();
            $data[] = $bookCount;
            $labels[] = now()->month($month->month)->translatedFormat('F');
        }

        return $this->chart->barChart()
            ->setHeight(300)
            ->setFontFamily('nunito')
            ->addData('Jumlah Buku', $data)
            ->setGrid('#3F51B5', 0.1)
            ->setLabels($labels);
    }
}
