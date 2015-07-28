<?php
use Illuminate\Database\Seeder;
use App\Country;

class CountriesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('countries')->truncate();

        $country = new Country();
        $country->name = 'England';
        $country->country_code = 'EN';
//        $language->icon = "icon_flag_gb.gif";
        $country->icon = "flag-en";
        $country->save();

        $country = new Country();
        $country->name = 'Ukraine';
        $country->country_code = 'UA';
//        $language->icon = "icon_flag_sr.gif";
        $country->icon = "flag-ua";
        $country->save();

        $country = new Country();
        $country->name = 'Russia';
        $country->country_code = 'RU';
//        $language->icon = "icon_flag_bs.gif";
        $country->icon = "flag-ru";
        $country->save();

        $country = new Country();
        $country->name = 'USA';
        $country->country_code = 'US';
//        $language->icon = "icon_flag_bs.gif";
        $country->icon = "flag-us";
        $country->save();
    }

}