# PhraseGenerator

Generate an English adjective-noun pair as a phrase (e.g. SubmissiveMonkey).

## Installation

`composer require badcow/phrase-generator`

## Usage

Program generates phrase with one adjective and one noun by default.

```php
<?php

require_once __DIR__.'/vendor/autoload.php';

use Badcow\PhraseGenerator\PhraseGenerator;

echo PhraseGenerator::generate(); // 1 adjective and 1 noun

```

You can also specify to use multiple adjectives or nouns with additional arguments.

```php
<?php

require_once __DIR__.'/vendor/autoload.php';

use Badcow\PhraseGenerator\PhraseGenerator;

echo PhraseGenerator::generate(2, 1); // 2 adjectives and 1 noun

```

## Example Phrases

 * UncomfortableTolerant
 * NeighboringTortellini
 * NearStep-grandmother
 * MotherlyTrachoma
 * ShallowAgony
 * PinkTemp
 * ImpossibleGrapefruit
 * ProbableHarvester
 * AmpleStep-mother
 * SaltyCommandment
 * KeenBowl
 * DishonestZombie
 * UnacceptableGoldfish
 * DefiantFridge
 * UncomfortableStab
 * AmazingDurian
 * MelodicCreature
 * PristineMustard
 * QuestionablePregnancy
 * IntentBody
 * SmallAcademics
 * MildInevitable
 * PrivateRestroom
 * CandidAutoimmunity
 * Well-groomedRemains
 * EnchantedScarf
 * BlaringTile
 * SpectacularTechnologist
 * FlawedSector
 * ScholarlySpinach
 * IroncladPorpoise
 * TemptingSage
 * PutridClub
 * BothThreat
 * NecessaryIntentionality
 * DownrightHousewife
 * FilthyCompetition
 * LinedArchitecture
 * TheseCemetery
 * RewardingRecruit
 * DiligentPicturesque
 * LivelyTactics
 * IdolizedHeritage
 * TrustingCash
 * GoldenNetball
 * GrippingVersion
 * IntentionalRevascularisation
 * DistinctCriticism
 * OurOpponent
 * PaleSponge
 * CalculatingLiner
