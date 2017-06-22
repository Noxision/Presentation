<?php
/**
 * WeatherAPI
 */
class WeatherAPI implements WeatherInterface
{
    private $url = "http://dataservice.accuweather.com/forecasts/v1/hourly/12hour/1-324505_1_AL?apikey=5Ai7nyHVGDeBaOFCltOJCVXacew7fqT3&language=ru-RU";
    private $data;
    private $dataAPI = [];

    public function __construct() {
        $this->data = json_decode(file_get_contents($this->url), true);
    }

    private function processingData() {
        foreach ($this->data as $i) {
            if ($i['WeatherIcon'] >= 12 && $i['WeatherIcon'] <= 18)
                $sky = 'Rain';
            elseif ($i['WeatherIcon'] >= 6 && $i['WeatherIcon'] <= 11)
                $sky = 'Clouds';
            else
                $sky = 'Clear';

            array_push($this->dataAPI, array(
                'dt' => $i['EpochDateTime'],
                'main'=> [ 'temp' => ($i['Temperature']['Value'] - 32) / 1.8],
                'dt_txt' => gmdate("Y-m-d H:i:s", $i['EpochDateTime']),
                'weather' => [['main' => $sky]],
            ));
        }
    }

    public function getWeather() {
        return $this->data;
    }
}
