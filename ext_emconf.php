<?php

$EM_CONF[$_EXTKEY] = [
    'author'           => 'Daniel Ablass',
    'author_email'     => 'dn@phantasie-schmiede.de',
    'category'         => 'misc',
    'clearCacheOnLoad' => true,
    'constraints'      => [
        'conflicts' => [],
        'depends'   => [
            'php'            => '8.1',
            'psb_foundation' => '2.0',
            'typo3'          => '12.4.0-13.4.99',
        ],
        'suggests'  => [],
    ],
    'description'      => 'Collection of useful ViewHelpers',
    'state'            => 'stable',
    'title'            => 'PSbits | ViewHelpers',
    'version'          => '2.0.1',
];
