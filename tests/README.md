# Carbon Breadcrumbs Unit Tests

1. Install [PHPUnit](http://phpunit.de/) by following their [installation guide](https://phpunit.de/getting-started.html). If you've installed it correctly, this should display the version:

    $ phpunit --version

2. Initialize the testing environment locally: `cd` into the plugin directory and run the install script (you will need to have `wget` installed).

  ```bash
  bash bin/install-wp-tests.sh wordpress_test root '' localhost latest
  ```

The install script first installs a copy of WordPress in the `/tmp` directory (by default) as well as the WordPress unit testing tools. Then it creates a database to be used while running tests. The parameters that are passed to `install-wp-tests.sh` setup the test database.

* `wordpress_test` is the name of the test database (**all data will be deleted!**)
* `root` is the MySQL user name
* `''` is the MySQL user password
* `localhost` is the MySQL server host
* `latest` is the WordPress version; could also be `3.7`, `3.6.2` etc.

NOTE: This script can be run multiple times without errors, but it will *not* overwrite previously existing files. So if your DB credentials change, or you want to switch to a different instance of mysql, simply re-running the script won't be enough. You'll need to manually edit the `wp-config.php` that's installed in `/tmp`.

**Important**: Make sure that you run this command from the **root** of the plugin.

3. Run the plugin tests: 

```bash
phpunit
```

Refer to the [phpunit command line test runner reference](https://phpunit.de/manual/current/en/phpunit-book.html#textui) for more information and command line options.

If you have trouble running the install script or phpunit, check [Support section](http://wp-cli.org/#support) for help and answers to common issues.