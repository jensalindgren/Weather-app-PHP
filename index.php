<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row header">
            <div class="col-12 text-center">
                <h1>Weather App</h1>
            </div>
        </div>

        <div class="row mt-5 s-1">
            <div class="col-12">
                <form method="GET">
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

        <!-- Display Weather and Forecast data here -->
        <div class="row weather-and-forecast">
            <?php
            if (isset($_GET['city'])) {
                include 'fetch_weather.php';
            }
            ?>
        </div>

        <!-- Footer -->
        <div class="row footer mt-5">
            <div class="col-12 text-center">
                <p>Created by: Jens Lindgren</p>
            </div>
        </div>
    </div>

    <!-- Bootstrap Scripts and other JavaScript -->
    <!-- Add your script tags -->
</body>

</html>