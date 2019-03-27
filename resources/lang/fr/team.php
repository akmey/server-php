<?php

return [

    'form' => [
        'create' => [
            'title' => 'Créer une équipe',
            'submit' => 'Créer !'
        ],
        'edit' => [
            'title' => 'Modifier :name',
            'submit' => 'Sauvegarder'
        ],
        'name' => [
            '_' => 'Nom de l\'équipe',
            'tooltip' => 'Choisissez un nom qui claque ! Il doit être unique.'
        ],
        'bio' => [
            '_' => 'Bio',
            'tooltip' => 'Décrivez votre équipe. (Compatible Markdown)'
        ],
        'adminopen' => [
            'title' => 'Autorisations des membres',
            'yes' => 'Les membres peuvent inviter des membres et éditer l\'équipe.',
            'no' => 'Les membres ne peuvent pas inviter de membres, ni éditer l\'équipe',
            'tooltip' => [
                'create' => 'Vous serez le seul à pouvoir supprimer l\'équipe, exclure des membres ou modifier les paramètres d\'autorisations.',
                'edit' => 'Vous êtes le seul à pouvoir supprimer l\'équipe, exclure des membres ou modifier les paramètres d\'autorisations.'
            ]
        ],
        'delete' => [
            'btn' => 'Supprimer',
            'one' => [
                'title' => 'Êtes-vous sûr ?',
                'desc' => 'Une fois supprimée, votre équipe disparaîtra pour toujours.'
            ],
            'two' => 'Votre équipe est toujours partie !'
        ],
        'saved' => 'Sauvegardé !'
    ],

    'newmember' => [
        'label' => 'Nouveau membre',
        'aria' => 'Entrez le nom d\'un nouveau membre',
        'success' => 'Invitation envoyée',
        'err' => [
            'empty' => 'Le champ est vide',
            'neterr' => 'Erreur réseau inconnue',
            'inteam' => 'Cet utilisateur est déjà dans l\'équipe',
            'already' => 'L\'invitation est encore en attente',
            'notfound' => 'Utilisateur non trouvé'
        ]
    ],

    'member' => [
        'quit' => 'Quitter l\'équipe'
    ]

];
