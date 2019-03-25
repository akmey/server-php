<?php

return [

    'title' => 'Tableau de bord',
    'logged' => 'Vous êtes connecté !',
    'sshnotice' => 'Connectez-vous à gui@:ssh avec votre client SSH favori pour ajouter vos clés ou collez-la en dessous (sans son commentaire).',

    'newkey' => [
        '_' => 'Nouvelle clé',
        'tooltip' => 'La majorité des clés sont acceptées',
        'aria' => 'Nouvelle clé (copiez-la sans son nom)',
        'err' => [
            'empty' => 'La clé est vide',
            'malformed' => 'La clé est invalide',
            'neterr' => 'Server refused our key. (Clé déjà utilisée, erreur réseau)'
        ]
    ],

    'table' => [
        'id' => '#',
        'name' => 'Nom de la clé',
        'key' => 'Contenu',
        'last' => 'Dernière mise à jour',
        'edit' => 'Éditer'
    ],

    'settings' => [
        '_' => 'Paramètres',
        'github' => 'Importer des clés d\'un compte GitHub',
        'export' => 'Exporter mon compte',
        'or' => 'ou',
        'import' => 'Importer mon compte',
        'delete' => [
            '_' => 'Supprimer mon compte',
            'tooltip' => 'Ceci va supprimer toutes vos données du serveur',
            'one' => [
                'title' => 'Êtes-vous sûr ?',
                'text' => 'Une fois supprimé, votre compte ainsi que ses données associés sera supprimé du serveur.'
            ],
            'two' => "C'est fait ! Votre compte disparaîtra dans un instant."
        ],
        'edit' => [
            '_' => 'Changer mon profil',
            'tooltip' => 'Changer le nom d\'utilisateur, l\'e-mail, le mot de passe'
        ],
        'oauth' => [
            '_' => 'Applications',
            'tooltip' => 'Ouvre le menu des applications OAuth'
        ]
    ],

    'edit' => [
        'title' => 'Éditer le clé :title',
        'name' => [
            '_' => 'Nom de la clé',
            'placeholder' => 'Ma clé de l\'ordinateur',
            'tooltip' => 'Utilisez ceci pour différencier vos clés.'
        ],
        'save' => 'Sauvegarder',
        'delete' => 'Supprimer',
        'popup' => [
            'one' => [
                'title' => 'Êtes-vous sûr ?',
                'desc' => 'Une fois supprimée, la clé sera retirée du serveur Akmey.'
            ],
            'two' => "C'est fait ! La clé disparaîtra dans un instant."
        ]
    ],

    'profile' => [
        '_' => 'Éditer mon profil',
        'picture' => [
            '_' => 'Photo de profil',
            'tooltip' => 'Une belle photo de profil !'
        ],
        'bio' => [
            '_' => 'Biographie',
            'tooltip' => 'Décrivez qui vous êtes ! (Compatible Markdown)'
        ],
        'username' => [
            '_' => 'Pseudonyme',
            'tooltip' => 'Il doit être unique et alphanumérique. Attention ! Votre ancien pseudo sera immédiatement disponible ! Certains clients Akmey ne supportent pas le changement de pseudo.'
        ],
        'email' => [
            '_' => 'Adresse e-mail',
            'tooltip' => 'Vous devrez confirmer votre nouvelle adresse e-mail avant de l\'utiliser.'
        ],
        'newpasswd' => [
            '_' => 'Nouveau mot de passe',
            'tooltip' => 'Choisissez un mot de passe fort ! (8 caract. min)'
        ],
        'oldpasswd' => [
            '_' => 'Ancien mot de passe',
            'tooltip' => 'Merci de réécrire votre mot de passe pour tout changement.'
        ],
        'save' => 'Sauvegarder',
        'page' => 'Profil'
    ],

    'oauth' => [
        'apps' => [
            '_' => 'Applications autorisées',
            'table' => [
                'name' => 'Nom',
                'scopes' => 'Autorisations',
                'revoke' => 'Révoquer'
            ]
        ],
        'dev' => [
            '_' => 'Développeur',
            'clients' => [
                '_' => 'Clients OAuth',
                'none' => 'Vous n\'avez pas créé de clients OAuth.',
                'table' => [
                    'id' => 'ID client',
                    'name' => 'Nom',
                    'secret' => 'Jeton secret',
                    'edit' => 'Éditer',
                    'delete' => 'Supprimer'
                ],
                'form' => [
                    '_' => 'Créer un client',
                    'edit' => 'Éditer un client',
                    'name' => [
                        '_' => 'Nom',
                        'tooltip' => 'Un nom qui inspire confiance à vos utilisateurs.'
                    ],
                    'redirect' => [
                        '_' => 'URL de redirection',
                        'tooltip' => 'L\'adresse URL de redirection (callback)'
                    ],
                    'close' => 'Fermer',
                    'create' => 'Créer',
                    'save' => 'Sauvegarder',
                    'err' => [
                        'title' => 'Oups !',
                        'sub' => 'Ça s\'est mal passé !'
                    ]
                ],
                'add' => 'Créer un client'
            ],
            'pat' => [
                '_' => 'Jetons personnels',
                'none' => 'Vous n\'avez pas créé de jetons personnels.',
                'name' => 'Nom',
                'form' => [
                    '_' => 'Créer un jeton',
                    'create' => 'Créer',
                    'name' => 'Nom',
                    'close' => 'Fermer',
                    'created' => 'Voici votre jeton personnel. Vous ne le reverrez plus jamais après donc sauvegarder le bien. Ce jeton est utilisable immédiatement.',
                    'scopes' => 'Autorisations',
                    'pat' => 'Jeton personnel',
                    'err' => [
                        'title' => 'Oups !',
                        'sub' => 'Ça s\'est mal passé !'
                    ]
                ],
                'table' => [
                    'name' => 'Nom',
                    'delete' => 'Supprimer'
                ],
                'add' => 'Créer un jeton'
            ]
        ]
    ],

    'github' => [
        'title' => 'Parfait !',
        'head' => 'Choississez vos clés à importer.',
        'btn' => 'Importer !',
        'err' => 'La clé ":name" n\'a pas pu être importée : cette clé est déjà utilisée.'
    ]

];
