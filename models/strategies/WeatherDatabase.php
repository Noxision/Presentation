<?php
/**
 * WeatherDatabase
 */
class WeatherDatabase implements WeatherInterface
{
    private $db;
    private $mysqli;
    private $selectQuery = 'SELECT timestamp, temperature, rain_possibility, clouds FROM forecast';
    private $result;
    private $selectArray = array();

    public function __construct() {
        $this->db = DatabaseConnection::getInstance();
        $this->mysqli = $this->db->getConnection();
        $this->result = $this->mysqli->query($this->selectQuery);
    }

    private function processingData() {
        if (mysqli_num_rows($this->result) > 0) {
            while ($fetchedArray = mysqli_fetch_assoc($this->result)) {
                $timestamp = strtotime($fetchedArray['timestamp']);
                if ($fetchedArray['rain_possibility'] > 0.7)
                    $sky = 'Rain';
                elseif ($fetchedArray['clouds'] > 20)
                    $sky = 'Clouds';
                else
                    $sky = 'Clear';

                $this->selectArray[] = array(
                    'dt' => $timestamp,
                    'main'=> ['temp' => $fetchedArray['temperature']],
                    'dt_txt' => $fetchedArray['timestamp'],
                    'weather' => [['main' => $sky]],
                );
            }
        }
    }

    public function getWeather() {
        $this->processingData();
        return json_encode($this->selectArray);
    }
}
