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
        $shippingDeadline = Config::get('myconfig.shipping_deadline');
        $excludeWeekday = Config::get('myconfig.exclude_weekday');
        $delaySetPrefectures = Config::get('myconfig.delay_set_prefectures');
        $destinationPrefecture = Config::get('myconfig.destination_prefecture');

        // 配送候補日を初期化
        $fetchDeliverySelectDays = [];
        $fetchDeliverySelectDaysValues = [];
        
        // 設定(1)
        // 最短発送日の値により開始日を設定
        $baseDate = Carbon::now()->addDays($fastestDeliveryDate)->startOfDay();

        // 現在時刻を取得
        $currentTime = Carbon::now()->hour;

        // 設定(3)
        // 発送締切設定が true の場合のみ、締切設定時間と現在時間を比較する
        if ($shippingDeadline['is_effective'] === true) {
            if ($currentTime >= $shippingDeadline['deadline_hour']) {
                // 締切設定時間を過ぎている場合のみ、最短発送日を設定日分後ろ倒す
                $delayDays = $shippingDeadline['delay_date'];
                $baseDate->addDays($delayDays);
            }
        }

        // 設定(5)
        // 設定された配送先によって最短発送日を各都道府県の値分、後ろ倒す
        foreach ($delaySetPrefectures as $prefecture) {
            if ($destinationPrefecture === $prefecture['id']) {
                $baseDate->addDays($prefecture['delay_date']);
                break;
            }
        }

        // 設定(2),(4)
        // 出力日数の値分配送候補日を取得し、追加する
        // 配送日を除外する曜日の設定が true の日付については、配送候補日に追加しない
        while (count($fetchDeliverySelectDays) < $outputDays) {
            if (!$excludeWeekday[$baseDate->dayOfWeek]['is_effective']) {
                $fetchDeliverySelectDays[] = $baseDate->isoFormat('YYYY年MM月DD日(ddd)');
                $fetchDeliverySelectDaysValues[] = $baseDate->format('Y-m-d');
            }
            $baseDate->addDay();
        }

        return view('form', compact(
            'fetchDeliverySelectDays',
            'fetchDeliverySelectDaysValues',
        ));
    }
}
