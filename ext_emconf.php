<?php

$EM_CONF[$_EXTKEY] = [
    'author'           => 'Daniel Ablass',
    'author_email'     => 'dn@phantasie-schmiede.de',
    'category'         => 'misc',
    'clearCacheOnLoad' => true,
    'constraints'      => [
        'conflicts' => [
        ],
        'depends'   => [
            'php'            => '7.4',
            'psb_foundation' => '1.0',
            'typo3'          => '11.5.5-11.5.99',
        ],
        'suggests'  => [
        ],
    ],
    'description'      => 'Collection of useful ViewHelpers',
    'state'            => 'stable',
    'title'            => 'PSbits | ViewHelpers',
    'version'          => '1.1.0',
];
