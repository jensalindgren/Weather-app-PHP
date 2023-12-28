<?php
if (!isset($_GET['city'])) {
    exit('City not provided');
}

$city = $_GET['city'];
$apiKey = 'a91191607fc8ae5f600ad85653a8470a';

$forecastAPI = "https://api.openweathermap.org/data/2.5/forecast?q={$city}&units=metric&appid={$apiKey}";

$forecastData = file_get_contents($forecastAPI);

if ($forecastData === false) {
    exit('Failed to fetch forecast data. Please try again later.');
}

$decodedForecastData = json_decode($forecastData, true);

if ($decodedForecastData === null || $decodedForecastData['cod'] !== '200') {
    if ($decodedForecastData['cod'] === '404') {
        exit('Forecast information not available for the provided city.');
    } else {
        exit('Error fetching forecast information. Please try again later.');
    }
}

echo "<div class='row forecast-container mt-5'>";
$daysToShow = 5; // Number of days to display

for ($i = 1; $i < $daysToShow; $i++) {
    $forecastItem = $decodedForecastData['list'][$i * 8]; // Data for each day (adjust index if needed)

    // Extract necessary information
    $timestamp = $forecastItem['dt'];
    $date = date('l', $timestamp);
    $temperature = $forecastItem['main']['temp'];
    $description = $forecastItem['weather'][0]['description'];
    $humidity = $decodedWeatherData['main']['humidity'];
    $windSpeed = $decodedWeatherData['wind']['speed'];
    $weatherCode = $forecastItem['weather'][0]['icon']; // Weather code for image URL

    // Convert weather code to image URL
    $imageUrl = "https://openweathermap.org/img/w/{$weatherCode}.png";

    // Display forecast information for each day in Bootstrap grid columns
    echo "<div class='col-3 weather-box text-center'>";
    echo "<div class='weather-details'>";
    echo "<p>{$date}</p>";
    echo "<img src='{$imageUrl}' alt='Weather Icon'>";
    echo "<p>Temperature: {$temperature}°C</p>";
    echo "<p>Description: {$description}</p>";
    echo "<div class='humidity'><span>Humidity: {$humidity}%</span></div>";
    echo "<div class='wind'><span>Wind Speed: {$windSpeed} m/s</span></div>";
    echo "</div>";
    echo "</div>";
}
echo "</div>"; // Close forecast container
