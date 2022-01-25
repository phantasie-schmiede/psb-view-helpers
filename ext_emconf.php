<?php
declare(strict_types=1);

$EM_CONF['psb_view_helpers'] = [
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
        ],
        'suggests'  => [
        ],
    ],
    'description'      => 'collection of useful ViewHelpers',
    'state'            => 'stable',
    'title'            => 'PSbits | ViewHelpers',
    'version'          => '1.0.0',
];
