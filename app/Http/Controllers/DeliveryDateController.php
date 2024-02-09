<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class DeliveryDateController extends Controller
{
    public function index()
    {
        // 設定値を取得
        $fastestDeliveryDate = Config::get('myconfig.fastest_delivery_date');
        $outputDays = Config::get('myconfig.output_days');

        // 配送候補日を生成
        $fetchDeliverySlecetDays = [];
        // 最短発送日の値により開始日を設定
        $startDate = Carbon::now()->addDays($fastestDeliveryDate)->startOfDay();

        // 出力日数の値分配送候補日を取得し、追加する
        for ($i = 0; $i < $outputDays; $i++) {
            $fetchDeliverySlecetDays[] = $startDate->format('Y-m-d');
            $startDate->addDay();
        }

        return view('form', compact(
            '',
        ));
    }

    public function store(Request $request)
    {
        // 
    }
}
