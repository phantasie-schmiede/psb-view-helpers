<?php

$EM_CONF[$_EXTKEY] = [
    'author'           => 'Daniel Ablass',
    'author_email'     => 'dn@phantasie-schmiede.de',
    'category'         => 'misc',
    'clearCacheOnLoad' => true,
    'constraints'      => [
        'conflicts' => [],
        'depends'   => [
            'php'            => '8.1.0-8.2.99',
            'psb_foundation' => '2.0.0-2.99.99',
            'typo3'          => '12.4.0-12.4.99',
        ],
        'suggests'  => [],
    ],
    'description'      => 'Collection of useful ViewHelpers',
    'state'            => 'stable',
    'title'            => 'PSbits | ViewHelpers',
    'version'          => '2.0.0',
];
