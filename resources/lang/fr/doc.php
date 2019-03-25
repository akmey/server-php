<?php

return [

    'privacy' => [
        '_' => 'Akmey et vos données',
        'head' => 'Quelles données Akmey collecte ?',
        'user' => [
            '_' => 'Données utilisateur',
            'desc' => 'Ces données sont personnelles et sous votre contrôle.',
            'name' => [
                '_' => 'Pseudonyme, adresse e-mail et mot de passe hashé',
                'desc' => 'Ces données servent à vous identifier, vous pouvez le changer.'
            ],
            'time' => [
                '_' => 'Date et heure de création de compte / dernier accès',
                'desc' => 'Ces données nous permettent, à des fins de sécurité, de garantir l\'intégrité de votre compte.'
            ],
            'keys' => [
                '_' => 'Clés SSH publiques',
                'desc' => 'Vos clés: celles que vous ajoutez.'
            ]
        ],
        'logs' => [
            '_' => 'Jouraux serveurs',
            'desc' => 'Les accès à Akmey sont journalisés.',
            'ip' => [
                '_' => 'IP',
                'desc' => 'Votre adresse Internet (IP) est sauvegardée.'
            ],
            'req' => [
                '_' => 'Requête',
                'desc' => 'Votre requête (URL, User-Agent & Referer)'
            ],
            'rot' => [
                '_' => 'Rotation des journaux',
                'desc' => 'Ces journaux sont stockés pour un maximum d\'1 an.'
            ],
            'err' => [
                '_' => 'Erreurs',
                'sentry' => 'Les journaux d\'erreurs sont transmis à un serveur Sentry pour analyse.',
                'local' => 'Les journaux d\'erreurs sont sauvegardés localement.'
            ]
        ],
        'end' => 'C\'est tout ! Nous ne collectons aucune autre donnée, aucune donnée n\'est passée dans des analytiques ou vendues à des publicitaires.',
        'warning' => [
            '_' => 'Utilisez un serveur Akmey de confiance !',
            'content' => 'Nous ne pouvons garantir que le serveur auquel vous vous inscrivez est sécurisé et de confiance. Vérifiez l\'intégrité de l\'hébergeur. Les développeurs d\'Akmey ne peuvent être tenus responsables en cas de violation.'
        ],
        'btn' => 'J\'accepte les conditions, continuer'
    ],

    'legal' => [
        'title' => 'Mentions légales',
        'agpl' => [
            '_' => ':app est un logiciel libre utilisant la licence AGPLv3. Le projet est disponible sur :link.',
            'link' => 'GitHub'
        ],
        'host' => 'Ce serveur est hébergé par :name, via :host, :details.',
        'more' => 'Informations supplémentaires fournies par l\'hébergeur :',
    ],

    'readme' => [
        'akmey' => [
            'title' => 'C\'est quoi Akmey ?',
            'desc' => [
                '_' => 'Akmey est équivalent aux serveurs de clés, mais non pas pour des clés GPG, pour des clés SSH ! Une :link existe et des applications sont là pour vous aider à récupérer les clés',
                'link' => 'API'
            ]
        ],
        'apps' => [
            'title' => 'Où puis-je télécharger les applications ?',
            'head' => 'Nous essayons de rendre Akmey disponible partout, nous avons un paquet CLI en Node.js et un client Go (en alpha) pour toutes les plateformes, tout est sous licence libre.',
            'list' => [
                'node' => 'Client NodeJS officiel',
                'install' => 'Script d\'installation automatisé',
                'go' => 'Client Akmey en Go',
                'server' => 'Serveur Akmey'
            ]
        ]
    ]

];
