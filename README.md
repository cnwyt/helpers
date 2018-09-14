# helpers

A Common Helper Functions for PHP


### Install

```
$ composer require cnwyt/helpers
```

composer.json :

```
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/cnwyt/helpers"
    }
]
```

### Usage

```
$user = \Cnwyt\Helpers\get_user_agent();

$str = 'cnwyt@outlookcom';
$result = \Cnwyt\Helpers\is_valid_email($str);

```

### Tests

```
$ cd helpers/
$ ./vendor/bin/phpunit tests/HelperTest.php
```