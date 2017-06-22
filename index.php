<?php
include('models/WeatherModel.php');
include('controllers/WeatherController.php');

if(isset($_POST['source'])) {
    $weather = new WeatherController( $_POST['source']);
    header('Content-Type: application/json');
    echo $weather->getWeather();
    exit();
}

include('views/template.php');
