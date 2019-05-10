<?php

namespace Badcow\PhraseGenerator;


class PhraseGenerator
{
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
    public static function generate():string
    {
        return ucfirst(self::getAdjective()).ucfirst(self::getNoun());
    }

    /**
     * Return a random adjective.
     *
     * @return string
     */
    private static function getAdjective(): string
    {
        if (empty(self::$adjectives)) {
            self::$adjectives = require_once 'Adjectives.php';
        }

        $index = array_rand(self::$adjectives);

        return self::$adjectives[$index];
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

        $index = array_rand(self::$nouns);

        return self::$nouns[$index];
    }

}