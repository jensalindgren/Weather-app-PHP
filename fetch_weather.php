<?php
if (!isset($_GET['city'])) {
    exit('City not provided');
}

$city = $_GET['city'];
$apiKey = 'd8d5d9e6b1ffc2fcbf1c3ab0bec153e6';

$weatherAPI = "https://api.openweathermap.org/data/2.5/weather?q={$city}&units=metric&appid={$apiKey}";

$weatherData = file_get_contents($weatherAPI);
$decodedWeatherData = json_decode($weatherData, true);

if ($decodedWeatherData && $decodedWeatherData['cod'] !== '404') {
    $weatherImage = ''; // Set weather image URL based on weather condition

    switch ($decodedWeatherData['weather'][0]['main']) {
        case 'Clouds':
            $weatherImage = 'assets/images/cloud.png';
            break;
        case 'Clear':
            $weatherImage = 'assets/images/clear.png';
            break;
        case 'Rain':
            $weatherImage = 'assets/images/rain.png';
            break;
        case 'Snow':
            $weatherImage = 'assets/images/snow.png';
            break;
        case 'Mist':
            $weatherImage = 'assets/images/mist.png';
            break;
        default:
            $weatherImage = ''; // Default image URL
    }

    $temperature = $decodedWeatherData['main']['temp'];
    $description = $decodedWeatherData['weather'][0]['description'];
    $humidity = $decodedWeatherData['main']['humidity'];
    $windSpeed = $decodedWeatherData['wind']['speed'];

    // Display weather information using HTML structure
    echo "<div class='row weather-box mt-3'>";
    echo "<div class='col-12 text-center'>";
    echo "<img src='{$weatherImage}' alt='Weather Icon'>";
    echo "<p>{$temperature}°C</p>";
    echo "<p>{$description}</p>";
    echo "<p>Humidity: {$humidity}%</p>";
    echo "<p>Wind Speed: {$windSpeed} m/s</p>";
    // Add more weather information as needed
    echo "</div>";
    echo "</div>";
} else {
    echo "Weather information not available";
}
