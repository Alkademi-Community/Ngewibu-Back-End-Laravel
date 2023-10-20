<?php

namespace Database\Seeders;

use App\Models\Province;
use App\Traits\WithProvincesData;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProvinceSeeder extends Seeder
{
    use WithProvincesData;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = $this->getValidProvincesDataToDatabase();
        Province::insert($data);
    }
    

    /**
     * Format the given province name by trimming whitespace, capitalizing the first letter of each word,
     * and returning the formatted string.
     *
     * @param string $provinceName The name of the province to format.
     * @return string The formatted province name.
     */
    private function formatProvinceName(string $provinceName): string
    {
        return Str::of($provinceName)
                  ->trim()
                  ->title()
                  ->toString();
    }

    /**
     * Get valid provinces data to be inserted into the database.
     *
     * @return array
     */
    private function getValidProvincesDataToDatabase(): array
    {
        $provinces = $this->getProvincesFromJson();

        $validProvinces = [];

        foreach ($provinces as $province) {
            $validProvinces[] = [
                'name'       => $this->formatProvinceName($province->name),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        sort($validProvinces);
        return $validProvinces;
    }
}
