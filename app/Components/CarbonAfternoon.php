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
    static function getDatesIntervalWithStop(Carbon $start, Carbon $stop, $count) {
        $intervals = static::getIntervalsWithoutNight($start, $stop);
    }
    static function getIntervalsWithoutNight(Carbon $start, Carbon $stop) {
        $start_time = $start->timestamp;
        $stop_time = $stop->timestamp;
        $interval = intval(($stop_time - $start_time) / 60);
        for($i = 1; $i<=$interval; $i++) {
            
        }

    }
}