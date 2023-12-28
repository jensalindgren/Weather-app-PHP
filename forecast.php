<?php
if (!isset($_GET['city'])) {
    exit('City not provided');
}

$city = $_GET['city'];
$apiKey = 'd8d5d9e6b1ffc2fcbf1c3ab0bec153e6';

$forecastAPI = "https://api.openweathermap.org/data/2.5/forecast?q={$city}&units=metric&appid={$apiKey}";

$forecastData = file_get_contents($forecastAPI);
$decodedForecastData = json_decode($forecastData, true);

if ($decodedForecastData) {
    $daysToShow = 4; // Number of days to display

    // Iterate through forecast data and display forecast for each day
    for ($i = 1; $i < $daysToShow; $i++) {
        $forecastItem = $decodedForecastData['list'][$i * 8]; // Data for each day (adjust index if needed)

        // Extract necessary information
        $timestamp = $forecastItem['dt'];
        $date = date('l', $timestamp);
        $temperature = $forecastItem['main']['temp'];
        $description = $forecastItem['weather'][0]['description'];

        // Display forecast information for each day
        echo "<div class='col-3 text-center'>";
        echo "<h4>{$date}</h4>";
        echo "<p>Temperature: {$temperature}°C</p>";
        echo "<p>Description: {$description}</p>";
        echo "</div>";
    }
} else {
    echo "Forecast information not available";
}
