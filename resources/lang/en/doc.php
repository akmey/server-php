<?php

return [

    'privacy' => [
        '_' => 'Akmey and your data',
        'head' => 'What data Akmey collect?',
        'user' => [
            '_' => 'User data',
            'desc' => 'These data are personal and under your control.',
            'name' => [
                '_' => 'Name, e-mail and hashed password',
                'desc' => 'We collect this data to identify you when you register, you can change it.'
            ],
            'time' => [
                '_' => 'Account creation time / Last access time',
                'desc' => 'This data allows us, for security reasons, to guarantee the integrity of your account.'
            ],
            'keys' => [
                '_' => 'SSH public keys',
                'desc' => 'Your keys: the ones you add on our website or via the SSH server.'
            ]
        ],
        'logs' => [
            '_' => 'Server logs',
            'desc' => 'Access to Akmey is logged.',
            'ip' => [
                '_' => 'IP',
                'desc' => 'Your IP is saved.'
            ],
            'req' => [
                '_' => 'Request',
                'desc' => 'Your request (URL, User-Agent & Referer)'
            ],
            'rot' => [
                '_' => 'Log rotation',
                'desc' => 'The logs are kept for a maximum of 1 year.'
            ],
            'err' => [
                '_' => 'Error logs',
                'sentry' => 'Errors logs are transmitted to a Sentry server for analysis.',
                'local' => 'Errors logs are saved on local files.'
            ]
        ],
        'end' => 'That\'s it ! We don\'t collect anything else, we don\'t process your data in analytics, we don\'t sell it to advertisers, none of that.',
        'warning' => [
            '_' => 'Use only an Akmey server you trust!',
            'content' => 'We cannot guarantee that the server on which you register is secure and respects your data. Check the integrity of the host before registering. Akmey developers cannot be held responsible if data is found to violate this privacy or security policy.'
        ],
        'btn' => 'I accept the terms, register'
    ],

    'legal' => [
        'title' => 'Legal',
        'agpl' => [
            '_' => ':app is free software under AGPLv3 license. The project is available on :link.',
            'link' => 'GitHub'
        ],
        'host' => 'This server is hosted by :name, via :host, :details.',
        'more' => 'Additional information from the host :',
    ],

    'readme' => [
        'akmey' => [
            'title' => 'What\'s Akmey?',
            'desc' => [
                '_' => 'Akmey is like keyservers, but not for GPG keys, for SSH ones! It has a simple :link and apps to retrieve keys and add it to your authorized_keys file.',
                'link' => 'API'
            ]
        ],
        'apps' => [
            'title' => 'Where i can download the apps?',
            'head' => 'We try to make Akmey accessible everywhere, so we have a npm cli package and a Go client (alpha) released for every platform, everything is under open-source license.',
            'list' => [
                'node' => 'Official Akmey client, NodeJS version',
                'install' => 'Automated install script',
                'go' => 'Akmey client in Go',
                'server' => 'Akmey server'
            ]
        ]
    ]

];
