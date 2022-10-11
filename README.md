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

### How it works

- If `$path` is not (part of) a Git repository and `$release` is in `X.Y.Z` format then `$release` is returned as-is.
* If `$path` is not (part of) a Git repository and `$release` is in `X.Y` format then `$release` is returned suffixed with `-dev`.
* If `$path` is (part of) a Git repository and `$release` is in `X.Y.Z` format then the output of `git describe --tags` is returned as-is.
* If `$path` is (part of) a Git repository and `$release` is in `X.Y` format then a string is returned that begins with `X.Y` and ends with information from `git describe --tags`.
