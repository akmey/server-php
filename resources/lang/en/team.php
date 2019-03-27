<?php

return [

    'form' => [
        'create' => [
            'title' => 'Create a team',
            'submit' => 'Create!'
        ],
        'edit' => [
            'title' => 'Edit :name',
            'submit' => 'Save'
        ],
        'name' => [
            '_' => 'Team name',
            'tooltip' => 'Choose a cool name! It must be unique.'
        ],
        'bio' => [
            '_' => 'Bio',
            'tooltip' => 'Describe your team. (Markdown compatible)'
        ],
        'adminopen' => [
            'title' => 'Members permissions',
            'yes' => 'Members can invite members and edit the team settings.',
            'no' => 'Members cannot invite members and edit the team settings.',
            'tooltip' => [
                'create' => 'You will be the only one who can delete the team, kick members or change permissions.',
                'edit' => 'You are the only one who can delete the team, kick members or change permissions.'
            ]
        ],
        'delete' => [
            'btn' => 'Delete',
            'one' => [
                'title' => 'Are you sure?',
                'desc' => 'Once deleted, your team will be removed from server.'
            ],
            'two' => 'Your team is now gone!'
        ],
        'saved' => 'Saved!'
    ],

    'newmember' => [
        'label' => 'New member',
        'aria' => 'Input new member username',
        'success' => 'Invitation sent',
        'err' => [
            'empty' => 'Member is empty',
            'neterr' => 'Unknown network error',
            'inteam' => 'User is already in team',
            'already' => 'Invitation is still pending',
            'notfound' => 'User not found'
        ]
    ],

    'member' => [
        'quit' => 'Quit the team'
    ]

];
