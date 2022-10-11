<?php
declare(strict_types=1);

use MarcAndreAppel\GitTag\GitTag;
use PHPUnit\Framework\TestCase;

class GitTagTest extends TestCase
{
    /**
     * @test
     */
    public function returns_empty_string_when_no_git_or_fallback(): void
    {
        $this->assertEquals('', GitTag::tag(__DIR__));
    }

    /**
     * @test
     */
    public function returns_fallback_when_no_git(): void
    {
        $this->assertEquals('1.1.0', GitTag::tag(path: __DIR__, fallback: '1.1.0'));
    }

    /**
     * @test
     */
    public function returns_correct_tag_from_git(): void
    {
        exec('mkdir git-dir && cd git-dir && git init && touch .gitkeep && git add . && git commit -am "v1.0.0" && git tag 1.0.0');
        $this->assertEquals('1.0.0', GitTag::tag(path: __DIR__.'/git-dir'));
        exec('rm -rf git-dir');
    }
}
