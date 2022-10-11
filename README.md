# git-tag

**git-tag** is a library that helps with retrieving the tag of git-hosted PHP projects.

## Installation

You can add this library as a local, per-project dependency to your project using [Composer](https://getcomposer.org/):

```shell
composer require marcandreappel/git-tag
```

If you only need this library during development, for instance to run your project's test suite, then you should add it as a development-time dependency:

```shell
composer require --dev marcandreappel/git-tag
```
## Usage

Here is a contrived example that shows the basic usage ; if the:

```php
<?php
declare(strict_types=1);

use MarcAndreAppel\GitTag\GitTag;

$tag = GitTag::tag(fallback: '1.0.0');

var_dump($tag);
```

```shell
string(5) "1.1.0"
```
