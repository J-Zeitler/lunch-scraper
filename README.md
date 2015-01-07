# lunch-scraper
a web-scraper for C's lunch menu

# install
1. Create a MySQL db
2. Fill in db credentials in `db.php`
3. Create a cronjob that runs the `scraper.php` script (suggested time interval is once per hour)

Table(s) will be created automatically when `scraper.php` is run. This script could also be run manually (it does not flood the db with duplicates).
