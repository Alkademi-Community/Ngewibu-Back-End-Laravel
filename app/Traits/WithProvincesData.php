<?php 

namespace App\Traits;

use Illuminate\Support\Facades\File;

trait WithProvincesData{
    /**
     * Get provinces data from provinces.json file.
     *
     * @return array
     */
    private function getProvincesFromJson(): array
    {
        $provinces = File::get(database_path('json/data/provinces.json'));

        return json_decode($provinces);
    }
}