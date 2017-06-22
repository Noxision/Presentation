<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Weather</title>
    <link rel="stylesheet" href="views/styles/app.css">
    <link href="https://fonts.googleapis.com/css?family=Quicksand|Titillium+Web" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>
<body>
<header>
    <h1>Modern weather app</h1>
</header>
<nav>
    <a href="" id="json" class="active">JSON</a>
    <a href="" id="database">Database</a>
    <a href="" id="API">API</a>
</nav>
<main>
    <div class="container">
        <div class="now clearfix">
            <div class="all-50">
                <div class="date"></div>
                <div class="current-temperature"></div>
            </div>
            <div class="all-50">
                <div class="weather-icon"></div>
            </div>
        </div>
        <div class="forecast"></div>
    </div>
</main>
<script src="views/scripts/app.js"></script>
</body>
</html>
