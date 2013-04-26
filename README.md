# Useful time-saving zend's bundle

Is goot to start with Zend skeleton application (get started here: http://framework.zend.com/manual/2.1/en/user-guide/overview.html)... It may look like this:

    curl -sS https://getcomposer.org/installer | php
    composer create-project --repository-url="http://packages.zendframework.com" zendframework/skeleton-application -s dev myproject
    (agree on removing vcs files)

## steps

Use composer, so You don't have to deal with autoloading and anything you don't want to deal with

### Add repo to composer.json

    "repositories" : [
        {
            "type": "vcs",
            "url": "https://github.com/pawlik/the-support.git"
        }
    ],
    "minimum-stability": "dev",

Minimum stability may not be required later, when I figure out how to make composer installing this package without it.

### Require packacge in composer.json

    "require": {
        "pawlik/the-support": "master"
    }

### run php composer.phar update

#Check out src/TheSupport/* folders and README's for more info