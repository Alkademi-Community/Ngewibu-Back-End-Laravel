<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Province;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Traits\WithProvincesData;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CitySeeder extends Seeder
{
    use WithProvincesData;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinces = (object)$this->getProvincesFromJson();
        $validCityData = [];

        foreach ($provinces as $province)
        {
            $validCityData = [...$validCityData, ...$this->getValidCitiesDataIntoDatabase($province->name)];
        }
        
        sort($validCityData);
        City::insert($validCityData);
    }

    /**
     * Get cities data from a JSON file based on the given province name.
     *
     * @param string $provinceName The name of the province to get the cities data from.
     * @return array The array of cities data.
     */
    private function getCitiesFromJson(string $provinceName): array
    {
        $cities = File::get(database_path("json/data/{$provinceName}.json"));

        return json_decode($cities);
    }

    /**
     * Returns an array of valid cities data to be inserted into the database for a given province.
     *
     * @param string $provinceName The name of the province to get the cities data for.
     * @return array The array of valid cities data to be inserted into the database.
     */
    private function getValidCitiesDataIntoDatabase(string $provinceName): array
    {
        $validCities = [];
        $provinceId = $this->getProvinceIdByProvinceName($provinceName);
        $fileName   = $this->formatProvinceName($provinceName);
        $cities     = (object)$this->getCitiesFromJson($fileName);

        foreach ($cities as $city)
        {
            $cityName = $city->name;

            $validCities[] = [
                'province_id' => $provinceId,
                'name'        => $cityName,
                'created_at'  => now(),
                'updated_at'  => now(),
            ];
        }
        

        sort($validCities);
        return $validCities;
    }

    /**
     * Format the given province name by converting it to lowercase, replacing spaces with underscores, and trimming it.
     *
     * @param string $provinceName The name of the province to format.
     * @return string The formatted province name.
     */
    private function formatProvinceName(string $provinceName): string
    {
        return Str::of($provinceName)
                    ->lower()
                    ->replace(' ', '_')
                    ->trim()
                    ->toString();
    }

    /**
     * Get the province ID by province name.
     *
     * @param string $provinceName The name of the province.
     *
     * @return int|null The ID of the province or null if not found.
     */
    private function getProvinceIdByProvinceName(string $provinceName): ?int
    {
        return Province::where('name', $provinceName)
                         ->select('id')
                         ->first()
                         ?->id;
    }
}
