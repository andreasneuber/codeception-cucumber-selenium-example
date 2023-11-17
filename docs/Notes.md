# Notes

## Run locally with Selenium Server Standalone
- Make sure Java is installed
- Download Selenium Server from https://www.selenium.dev/downloads/ > scroll down a bit
- Run `java -jar selenium-server-4.15.0 standalone --selenium-manager true`
- Check `http://localhost:4444` - you should see "Selenium Grid"
- In file `codeception.dist.yml` change Webdriver port from 9515 to 4444
- Run `php vendor/bin/codecept run --steps --html` (in an extra terminal)

