<?php

namespace App\Traits;

use App\Models\City;
use App\Models\User;
use App\Models\Event;
use App\Models\LuEventStatus;
use App\Models\LuEventType;

trait WithFactoryDataCount{

    public function getUserCount(): int
    {
        return User::count();
    }

    public function getEventCount(): int
    {
        return Event::count();
    }

    public function getEventStatusCount(): int
    {
        return LuEventStatus::count();
    }

    public function getEventTypeCount(): int
    {
        return LuEventType::count();
    }

    public function getCityCount(): int
    {
        return City::count();
    }
}