<?php

namespace Badcow\PhraseGenerator\Tests;

use Badcow\PhraseGenerator\PhraseGenerator;
use PHPUnit\Framework\TestCase;

class PhaseGeneratorTest extends TestCase
{
    private function isAnAdjective(string $word): bool
    {
        $adjectives = require __DIR__ . '/../src/Adjectives.php';

        return in_array(strtolower($word), $adjectives);
    }

    private function isANoun(string $word): bool
    {
        $nouns = require __DIR__ . '/../src/Nouns.php';

        return in_array(strtolower($word), $nouns);
    }

    public function testWillGrabTwoCamelCasedWordsByDefault()
    {
        $phrase = PhraseGenerator::generate();

        // 1: means that the pattern was found.
        self::assertEquals(1, preg_match('/[A-Z][a-z]+[A-Z][a-z]+/', $phrase), 'The two camel-cased words regex failed.');
    }

    public function testTheFirstWordWillAlwaysBeAnAdjective()
    {
        $phrase = PhraseGenerator::generate();

        // 1: means that the pattern was found.
        preg_match('/([A-Z][a-z]+)[A-Z][a-z]+/', $phrase, $matches);

        self::assertNotEmpty($matches[1], 'The Adjective regex failed.');
        self::assertTrue($this->isAnAdjective($matches[1]), 'The first word was not an adjective.');
    }

    public function testTheSecondWordWillAlwaysBeANoun()
    {
        $phrase = PhraseGenerator::generate();

        // 1: means that the pattern was found.
        preg_match('/[A-Z][a-z]+([A-Z][a-z]+)/', $phrase, $matches);

        self::assertNotEmpty($matches[1], 'The Noun regex failed.');
        self::assertTrue($this->isANoun($matches[1]), 'The second word was not a noun.');
    }
}
