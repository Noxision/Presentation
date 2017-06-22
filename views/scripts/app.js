$(document).ready(function () {

    $('#json').on('click', function (e) {
        $.post("index.php", {'source': 'JSON'}, function (data) {
            appendSection(data.list);
        });
        classToggle(this);
        e.preventDefault();
    });

    $('#database').on('click', function (e) {
        $.post('index.php', {'source': 'DATABASE'}, function (data) {
            appendSection(data);
        });
        classToggle(this);
        e.preventDefault();
    });

    $('#API').on('click', function (e) {
        $.post('index.php', {'source': 'API'}, function (data) {
            appendSection(data);
        });
        classToggle(this);
        e.preventDefault();
    });

    $('.active').trigger('click');

    function appendSection(data) {
        var lastStamp = 0;
        var lastTemp = 0;
        var lastSkyIcon = '';
        var curDate = Date.now() / 1000 | 0;
        $('.forecast').html("");
        $.each(data.reverse(), function (index, value) {
            if (value.main.temp > 200)
                var formattedTemp = Math.round(value.main.temp - 273.15);
            else
                var formattedTemp = Math.round(value.main.temp);
            var icon = iconsHandler(value.weather[0].main);
            var str = '<div id="' + 'weather_row_' + index + '" class="hourly-forecast clearfix">' +
                '<div class="forecast-date">' + value.dt_txt + '</div>' +
                '<div class="forecast-weather">' +
                '<div class="forecast-temperature">' + formattedTemp + ' &deg;</div>' +
                '<div class="forecast-icon">' + icon +
                '</div></div></div>';
            $('.forecast').append(str);

            if ((curDate - value.dt) < (curDate - lastStamp)) {
                lastStamp = value.dt;
                lastTemp = formattedTemp;
                lastSkyIcon = icon;
            }
        });

        $('.current-temperature').html(lastTemp + ' &deg;');
        var daysInWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

        var date = new Date(lastStamp * 1000);
        $('.date').html(daysInWeek[date.getDay()] + " " + date.getDate() + "/" + (date.getMonth() + 1));
        $('.weather-icon').html("");
        $('.weather-icon').append(lastSkyIcon);
    }

    function iconsHandler(weatherSky) {
        var sky = {
            'Clear': '002-sun.svg',
            'Rain': '003-rain.svg',
            'Clouds': '005-sky.svg'
        };
        return '<img src="views/img/icons/' + sky[weatherSky] + '" alt="Weather icon">';
    }

    function classToggle(elem) {
        $('.active').toggleClass('active');
        $(elem).toggleClass('active');
    }
});
