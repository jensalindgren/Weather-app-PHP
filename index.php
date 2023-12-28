<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link type="text/css" rel="stylesheet" href="assets/css/styles.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/7c8801c017.js" crossorigin="anonymous"></script>
</head>

<body>

    <div class="container-fluid">
        <!-- Header -->
        <div class="row header">
            <div class="col-12 text-center">
                <h1>Weather App</h1>
            </div>
        </div>

        <!-- Search box -->
        <div class="row mt-5 s-1">
            <div class="col-12">
                <form method="GET" action="">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-location-dot"></i></span>
                        </div>
                        <input type="text" class="form-control" name="city" placeholder="Enter your location">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Display Weather Information -->
        <?php
        if (isset($_GET['city'])) {
            $city = $_GET['city'];
            include 'fetch_weather.php'; // Include PHP logic to fetch weather data
            if ($decodedWeatherData && $decodedWeatherData['cod'] !== '404') {
                include 'forecast.php'; // Include PHP logic to fetch forecast data

                // Display the weather box
                echo "<div class='row weather-box mt-3'>";
                echo "<div class='col-12 text-center'>";
                echo "<img src='{$weatherImage}' alt='Weather Icon'>";
                echo "<p>{$temperature}°C</p>";
                echo "<p>{$description}</p>";
                echo "<p>Humidity: {$humidity}%</p>";
                echo "<p>Wind Speed: {$windSpeed} m/s</p>";
                echo "</div>";
                echo "</div>";

                // Display the forecast container if forecast data is available
                if ($decodedForecastData && $decodedForecastData !== 'Forecast information not available') {
                    echo "<div class='row forecast-container mt-5'>";
                    echo "<div class='col-12'>";
                    echo "<h2 class='text-center'>Forecast</h2>";
                    echo "<div class='forecast'>";
                    foreach ($decodedForecastData as $dayForecast) {
                        echo "<div class='forecast-item'>";
                        echo "<div class='day'>" . $dayForecast['dayOfWeek'] . "</div>";
                        echo "<img src='" . $dayForecast['weatherImage'] . "' alt='Weather Icon' class='forecast-image'>";
                        echo "<div class='temperature'>" . $dayForecast['temperature'] . "°C</div>";
                        echo "<div class='description'>" . $dayForecast['description'] . "</div>";
                        echo "</div>";
                    }
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
            }
        }
        ?>

        <!-- Footer -->
        <div class="row footer mt-5">
            <div class="col-12 text-center">
                <p>Created by: Jens Lindgren</p>
            </div>
        </div>
    </div>

    <!-- Bootstrap Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>