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

namespace Badcow\PhraseGenerator;

class PhraseGenerator
{
    /**
     * Maximum number of entropy retries.
     *
     * @var int
     */
    private const MAX_ENTROPY_ATTEMPTS = 5;

    /**
     * A list of adjectives.
     *
     * @var string[]
     */
    private static $adjectives = [];

    /**
     * A list of nouns.
     *
     * @var string[]
     */
    private static $nouns = [];

    /**
     * Generates a random string of adjectives and nouns.
     */
    public static function generate(int $numAdjectives = 1, int $numNouns = 1): string
    {
        $phrase = '';

        for ($i = 0; $i < $numAdjectives; ++$i) {
            $phrase .= ucfirst(self::getAdjective());
        }

        for ($i = 0; $i < $numNouns; ++$i) {
            $phrase .= ucfirst(self::getNoun());
        }

        return $phrase;
    }

    /**
     * Returns a random array element, ideally using PHP's cryptographically-secure PRNG.
     *
     * @param mixed[] $in
     *
     * @return mixed
     */
    protected static function pluckRandom(array $in)
    {
        // Handle non-numerical key arrays.
        $tmp = array_values($in);
        $max = count($tmp) - 1;

        for ($attempt = 0; $attempt < self::MAX_ENTROPY_ATTEMPTS; ++$attempt) {
            try {
                $index = random_int(0, $max);

                break;
            } catch (\Exception $e) {
                // Not enough entropy. Let's retry for up to half a second.
                usleep(100000);
            }
        }

        // If it is still not set, use array_rand() instead.
        $index = $index ?? array_rand($tmp);

        return $tmp[$index];
    }

    /**
     * Return a random adjective.
     */
    public static function getAdjective(): string
    {
        if (empty(self::$adjectives)) {
            self::$adjectives = require_once 'Adjectives.php';
        }

        return self::pluckRandom(self::$adjectives);
    }

    /**
     * Return a random noun.
     */
    public static function getNoun(): string
    {
        if (empty(self::$nouns)) {
            self::$nouns = require_once 'Nouns.php';
        }

        return self::pluckRandom(self::$nouns);
    }
}
