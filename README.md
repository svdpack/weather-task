# Deploy

1. Execute `db.sql` script

2. Set cron job: `0 * * * * /path/to/script/cron-1-hour.php`  
for collect some data from weather api server


# API

Get daily temperature array

Call GET `/api/weather/?day=Y-m-d`

X-token you can find in config file.
