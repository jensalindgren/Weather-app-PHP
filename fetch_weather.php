<?php
if (!isset($_GET['city'])) {
    exit('City not provided');
}

$city = $_GET['city'];
$apiKey = 'd8d5d9e6b1ffc2fcbf1c3ab0bec153e6';

$weatherAPI = "https://api.openweathermap.org/data/2.5/weather?q={$city}&units=metric&appid={$apiKey}";
$forecastAPI = "https://api.openweathermap.org/data/2.5/forecast?q={$city}&units=metric&appid={$apiKey}";

// Fetch weather data
$weatherData = file_get_contents($weatherAPI);
$weatherInfo = json_decode($weatherData, true);

// Fetch forecast data
$forecastData = file_get_contents($forecastAPI);
$forecastInfo = json_decode($forecastData, true);

if ($weatherInfo && $forecastInfo) {
    echo "<div class='col-12 text-center'>";
    echo "<h1>{$weatherInfo['name']}</h1>";
    echo "<img src='http://openweathermap.org/img/w/{$weatherInfo['weather'][0]['icon']}.png' alt='Weather Icon'>";
    echo "<p>{$weatherInfo['main']['temp']}°C</p>";
    echo "<p>{$weatherInfo['weather'][0]['description']}</p>";
    echo "</div>";

    // Display forecast data
    for ($i = 0; $i < 4; $i++) {
        $day = date('l', $forecastInfo['list'][$i]['dt']);
        $temp = $forecastInfo['list'][$i]['main']['temp'];
        $description = $forecastInfo['list'][$i]['weather'][0]['description'];

        echo "<div class='col-3 text-center'>";
        echo "<h4>{$day}</h4>";
        echo "<p>{$temp}°C</p>";
        echo "<p>{$description}</p>";
        echo "</div>";
    }
} else {
    echo "Weather information not available";
}
