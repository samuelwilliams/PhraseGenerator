<?php

declare(strict_types=1);

/*
 * This file is part of Badcow Phrase Generator.
 *
 * (c) Samuel Williams <sam@badcow.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Badcow\PhraseGenerator\Tests;

use Badcow\PhraseGenerator\PhraseGenerator;
use PHPUnit\Framework\TestCase;

class PhraseGeneratorTest extends TestCase
{
    private function isAnAdjective(string $word): bool
    {
        $adjectives = require __DIR__.'/../src/Adjectives.php';

        return in_array(strtolower($word), $adjectives);
    }

    private function isANoun(string $word): bool
    {
        $nouns = require __DIR__.'/../src/Nouns.php';

        return in_array(strtolower($word), $nouns);
    }

    public function testWillGrabTwoCamelCasedWordsByDefault()
    {
        for ($i = 0; $i < 32; ++$i) {
            $phrase = PhraseGenerator::generate();

            // 1: means that the pattern was found.
            $this->assertEquals(1, preg_match('/[A-Z][a-z\-]+[A-Z][a-z\-]+/', $phrase), 'The two camel-cased words regex failed.');
        }
    }

    public function testTheFirstWordWillAlwaysBeAnAdjective()
    {
        for ($i = 0; $i < 32; ++$i) {
            $phrase = PhraseGenerator::generate();

            // 1: means that the pattern was found.
            preg_match('/([A-Z][a-z\-]+)[A-Z][a-z\-]+/', $phrase, $matches);

            $this->assertNotEmpty($matches[1], 'The Adjective regex failed.');
            $this->assertTrue($this->isAnAdjective($matches[1]), 'The first word was not an adjective.');
        }
    }

    public function testTheSecondWordWillAlwaysBeANoun()
    {
        for ($i = 0; $i < 32; ++$i) {
            $phrase = PhraseGenerator::generate();

            // 1: means that the pattern was found.
            preg_match('/[A-Z][a-z\-]+([A-Z][a-z\-]+)/', $phrase, $matches);

            $this->assertNotEmpty($matches[1], 'The Noun regex failed.');
            $this->assertTrue($this->isANoun($matches[1]), 'The second word was not a noun.');
        }
    }

    public function testWillGrabMultipleAdjectives()
    {
        for ($i = 0; $i < 32; ++$i) {
            $phrase = PhraseGenerator::generate(2, 1);

            // 1: means that the pattern was found.
            preg_match('/([A-Z][a-z\-]+)([A-Z][a-z\-]+)[A-Z][a-z\-]+/', $phrase, $matches);

            $this->assertNotEmpty($matches[1], 'The Adjective regex failed.');
            $this->assertTrue($this->isAnAdjective($matches[1]), 'The first word was not an adjective.');

            $this->assertNotEmpty($matches[2], 'The Adjective regex failed.');
            $this->assertTrue($this->isAnAdjective($matches[2]), 'The second word was not an adjective.');
        }
    }

    public function testWillGrabMultipleNouns()
    {
        for ($i = 0; $i < 32; ++$i) {
            $phrase = PhraseGenerator::generate(1, 2);

            // 1: means that the pattern was found.
            preg_match('/[A-Z][a-z\-]+([A-Z][a-z\-]+)([A-Z][a-z\-]+)/', $phrase, $matches);

            $this->assertNotEmpty($matches[1], 'The Noun regex failed.');
            $this->assertTrue($this->isANoun($matches[1]), 'The first word was not a noun.');

            $this->assertNotEmpty($matches[2], 'The Noun regex failed.');
            $this->assertTrue($this->isANoun($matches[2]), 'The second word was not a noun.');
        }
    }
}
