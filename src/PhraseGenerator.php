<?php declare(strict_types=1);

namespace Badcow\PhraseGenerator;

class PhraseGenerator
{
    private const MAX_ENTROPY_ATTEMPTS = 5;

    /**
     * @var array
     */
    private static $adjectives = [];

    /**
     * @var array
     */
    private static $nouns = [];

    /**
     * @return string
     */
    public static function generate(): string
    {
        return ucfirst(self::getAdjective()) . ucfirst(self::getNoun());
    }

    /**
     * Returns a random array element, ideally using PHP's cryptographically-secure PRNG.
     *
     * @param array $in
     * @return mixed
     */
    protected static function pluckRandom(array $in)
    {
        // Handle non-numerical key arrays.
        $tmp = array_values($in);

        for ($attempt = 0; $attempt < self::MAX_ENTROPY_ATTEMPTS; ++$attempt) {
            try {
                $index = random_int(0, count($tmp));

                break;
            } catch (\Exception $e) {
                // Not enough entry. Let's retry for up to half a second.
                usleep(100000);
            }
        }

        // If it's still not set, fuck it. Just use array_rand().
        $index = $index ?? array_rand($tmp);

        return $tmp[$index];
    }

    /**
     * Return a random adjective.
     */
    private static function getAdjective(): string
    {
        if (empty(self::$adjectives)) {
            self::$adjectives = require_once 'Adjectives.php';
        }

        return self::pluckRandom(self::$adjectives);
    }

    /**
     * Return a random noun.
     *
     * @return string
     */
    private static function getNoun(): string
    {
        if (empty(self::$nouns)) {
            self::$nouns = require_once 'Nouns.php';
        }

        return self::pluckRandom(self::$nouns);
    }
}
