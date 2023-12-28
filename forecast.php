<?php
if (!isset($_GET['city'])) {
    exit('City not provided');
}

$city = $_GET['city'];
$apiKey = 'a91191607fc8ae5f600ad85653a8470a';

$forecastAPI = "https://api.openweathermap.org/data/2.5/forecast?q={$city}&units=metric&appid={$apiKey}";

$forecastData = file_get_contents($forecastAPI);
$decodedForecastData = json_decode($forecastData, true);

if ($decodedForecastData && $decodedForecastData['cod'] === '200') {
    echo "<div class='row forecast-container mt-5'>";
    $daysToShow = 4; // Number of days to display

    // Start the loop from the current day's forecast
    for ($i = 0; $i < $daysToShow; $i++) {
        $forecastItem = $decodedForecastData['list'][$i * 8]; // Data for each day (adjust index if needed)

        // Extract necessary information
        $timestamp = $forecastItem['dt'];
        $date = date('l', $timestamp);
        $temperature = $forecastItem['main']['temp'];
        $description = $forecastItem['weather'][0]['description'];
        $weatherCode = $forecastItem['weather'][0]['icon']; // Weather code for image URL

        // Convert weather code to image URL
        $imageUrl = "https://openweathermap.org/img/w/{$weatherCode}.png";

        // Display forecast information for each day in Bootstrap grid columns
        echo "<div class='col-3 text-center'>";
        echo "<h4>{$date}</h4>";
        echo "<img src='{$imageUrl}' alt='Weather Icon'>";
        echo "<p>Temperature: {$temperature}°C</p>";
        echo "<p>Description: {$description}</p>";
        echo "</div>";
    }
    echo "</div>"; // Close forecast container
} else {
    echo "Forecast information not available";
}
