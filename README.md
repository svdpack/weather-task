Execute db.sql script
Set cron job:   0 * * * * /path/to/script/getWeatherFromApi.php   for collect some data from weather api server
Call localhost:port/?day=Y-m-d in browser to get daily temperature array.
X-token you can find in config file.
