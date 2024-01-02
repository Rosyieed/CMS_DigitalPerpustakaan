<?php

namespace App\Charts;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class BooksbyCategoryChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
            $categories = Category::all();

            $data = [];
            $labels = [];

            foreach ($categories as $category) {
                $bookCount = Book::where('category_id', $category->id)->count();
                $data[] = $bookCount;
                $labels[] = $category->name;
            }

            return $this->chart->pieChart()
                ->setWidth(360)
                ->setFontFamily('nunito')
                ->addData($data)
                ->setLabels($labels);
        }
}
