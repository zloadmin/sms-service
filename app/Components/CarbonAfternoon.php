<?php

namespace App\Components;

use Carbon\Carbon;

class CarbonAfternoon extends Carbon {

    const BNOON = 23;
    const ANOON = 7;

    public function startOfAfternoon()
    {
        if($this->hour>=self::BNOON) return $this->addDays(1)->hour(self::ANOON)->minute(0)->second(0);
        if($this->hour<=self::ANOON) return $this->hour(self::ANOON)->minute(0)->second(0);
        return $this;
    }
}