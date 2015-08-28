<?php

namespace App\Components;

use Carbon\Carbon;

class CarbonAfternoon extends Carbon {

    const BNOON = 23;
    const ANOON = 7;
    const ALLNIGHT = 8;

    public function startOfAfternoon()
    {
        if($this->hour>=self::BNOON) return $this->addDays(1)->hour(self::ANOON)->minute(0)->second(0);
        if($this->hour<=self::ANOON) return $this->hour(self::ANOON)->minute(0)->second(0);
        return $this;
    }
    static function getDatesInterval(Carbon $start, $interval, $count)
    {

        $data_array = array();

        for($i = 1; $i<=$count;$i++) {

            if($i===1) {

                $data_array[$i] = $start->toDateTimeString();

            } else {

                $lastDate = end($data_array);

                if(static::parse($lastDate)->hour>=self::BNOON) {
                    $data_array[$i] = static::parse($lastDate)->addMinutes($interval)->addHours(self::ALLNIGHT)->toDateTimeString();
                } else {
                    $data_array[$i] = static::parse($lastDate)->addMinutes($interval)->toDateTimeString();
                }

            }

        }

        return $data_array;
    }
    static function getDatesIntervalWithStop(Carbon $start, Carbon $stop, $count)
    {
        $intervals = static::getIntervalsWithoutNight($start, $stop);
        $period = static::getAllPeriod($intervals);
        $step = intval($period / $count);

        $AllDates = static::getDatesWithPeriods($step, $intervals);

        if(count($AllDates)>$count) {

        }
        return $AllDates;
    }
    static function getIntervalsWithoutNight(Carbon $start, Carbon $stop)
    {
        $start_time = $start->timestamp;
        $stop_time = $stop->timestamp;
        $interval = intval(($stop_time - $start_time) / 60);

        $datas = array();
        $datas[] = $start->timestamp;
            for($i = 1; $i<=$interval; $i++) {
                $start->addMinute();
                if($start->hour == self::BNOON AND $start->minute == 0) {
                    $datas[] = $start->timestamp;
                }
                if($start->hour == self::ANOON AND $start->minute == 0) {
                    $datas[] = $start->timestamp;
                }

            }
        $datas[] = $stop->timestamp;
//        $datas[] = $start->toDateTimeString();
//        for($i = 1; $i<=$interval; $i++) {
//            $start->addMinute();
//            if($start->hour == self::BNOON AND $start->minute == 0) {
//                $datas[] = $start->toDateTimeString();
//            }
//            if($start->hour == self::ANOON AND $start->minute == 0) {
//                $datas[] = $start->toDateTimeString();
//            }
//
//        }
//        $datas[] = $stop->toDateTimeString();
        if(count($datas) % 2  == 1) array_pop($datas);

        return $datas;
    }
    static function getAllPeriod($intervals)
    {
        $AllPeriod = 0;

        foreach($intervals as $i => $interval) {
            if($i % 2  == 1) {
                $AllPeriod = $AllPeriod + ($intervals[$i] - $intervals[$i - 1]);
            }
        }
        return $AllPeriod;
    }
    static function getDatesWithPeriods($step, $intervals)
    {
        $datas = array();

        foreach($intervals as $i => $v) {
            if($i % 2  == 1) {
                $start = $intervals[$i - 1] - $intervals[0];
                $stop = $intervals[$i] - $intervals[0];

                for($v = $start; $v<=$stop;) {
                    $time = $v + $intervals[0];
                    $datas[] = date("Y-m-d H:i:s", $time);
                    $v = $v + $step;
                }


            }
        }

        return $datas;
    }
}