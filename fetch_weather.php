<?php
if (!isset($_GET['city'])) {
    exit('City not provided');
}

$city = $_GET['city'];
$apiKey = 'a91191607fc8ae5f600ad85653a8470a';

$weatherAPI = "https://api.openweathermap.org/data/2.5/weather?q={$city}&units=metric&appid={$apiKey}";

$weatherData = file_get_contents($weatherAPI);
$decodedWeatherData = json_decode($weatherData, true);

if ($decodedWeatherData && $decodedWeatherData['cod'] !== '404') {
    $temperature = $decodedWeatherData['main']['temp'];
    $description = $decodedWeatherData['weather'][0]['description'];
    $humidity = $decodedWeatherData['main']['humidity'];
    $windSpeed = $decodedWeatherData['wind']['speed'];
    $weatherCode = $decodedWeatherData['weather'][0]['icon']; // Weather code for image URL

    // Construct the image URL for the weather icon
    $imageUrl = "https://openweathermap.org/img/w/{$weatherCode}.png";

    // Display weather information using HTML structure
    echo "<div class='row weather-box mt-7'>";
    echo "<div class='col-12 text-center'>";
    echo "<h2>Current Weather</h2>";
    echo "<h3>{$city}</h3>";
    echo "<h4>{$temperature}°C</h4>";
    echo "<img src='{$imageUrl}' alt='Weather Icon'>";
    echo "<p>{$description}</p>";
    echo "<p>Humidity: {$humidity}%</p>";
    echo "<p>Wind Speed: {$windSpeed} m/s</p>";
    echo "</div>";
    echo "</div>";
} else {
    echo "Weather information not available";
}
