<?php
declare(strict_types=1);

namespace MarcAndreAppel\GitTag;

/**
 * @copyright Marc-André Appel <marc-andre@appel.fun>
 * @copyright Sebastian Bergmann <sebastian@phpunit.de>
 *
 * @license see https://github.com/marcandreappel/git-tag/blob/main/LICENSE.md
 */
final class GitTag
{
    public static function tag(string $path, ?string $fallback = null): string
    {
        if ($git = (new self)->getGitInformation($path)) {
            $git = explode('-', $git);

            return array_shift($git);
        }

        return $fallback ?? '';
    }

    private function getGitInformation(?string $path): bool|string
    {
        if ($path === null) {
            $path = __DIR__;
        }
        if (!is_dir($path . DIRECTORY_SEPARATOR . '.git')) {
            return false;
        }

        $process = proc_open(
            'git describe --tags',
            [
                1 => ['pipe', 'w'],
                2 => ['pipe', 'w'],
            ],
            $pipes,
            $path
        );

        if (!is_resource($process)) {
            return false;
        }

        $result = trim(stream_get_contents($pipes[1]));

        fclose($pipes[1]);
        fclose($pipes[2]);

        $returnCode = proc_close($process);

        if ($returnCode !== 0) {
            return false;
        }

        return $result;
    }
}
