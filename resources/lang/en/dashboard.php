<?php

return [

    'title' => 'Dashboard',
    'logged' => 'You are logged in!',
    'sshnotice' => 'Connect to gui@:ssh with your favourite SSH client to add your keys or paste your key down below (without key comment).',

    'newkey' => [
        '_' => 'New key',
        'tooltip' => 'We accept major key types'
    ],

    'table' => [
        'id' => '#',
        'name' => 'Key name',
        'key' => 'Content',
        'last' => 'Last updated',
        'edit' => 'Edit'
    ],

    'settings' => [
        '_' => 'Settings',
        'github' => 'Import keys from a GitHub account',
        'export' => 'Export my account',
        'or' => 'or',
        'import' => 'Import my account',
        'delete' => [
            '_' => 'Delete my account',
            'tooltip' => 'This will delete all your account data from this server',
            'one' => [
                'title' => 'Are you sure?',
                'text' => 'Once deleted, your account and your keys will be removed from Akmey server.'
            ],
            'two' => "That's it, your account will disappear from servers in a while."
        ],
        'edit' => [
            '_' => 'Change my profile',
            'tooltip' => 'Edit your username, e-mail, password'
        ],
        'oauth' => [
            '_' => 'OAuth Apps',
            'tooltip' => 'Open the OAuth Apps settings'
        ]
    ],

    'edit' => [
        'title' => 'Edit key :title',
        'name' => [
            '_' => 'Key name',
            'placeholder' => 'My computer key',
            'tooltip' => 'Use this to make the difference between your keys.'
        ],
        'save' => 'Save',
        'delete' => 'Delete',
        'popup' => [
            'one' => [
                'title' => 'Are you sure?',
                'desc' => 'Once deleted, the key will be removed from Akmey server.'
            ],
            'two' => "That's it, your key will disappear from servers in a while."
        ]
    ],

    'profile' => [
        '_' => 'Edit my profile',
        'picture' => [
            '_' => 'Profile picture',
            'tooltip' => 'Upload a nice profile picture!'
        ],
        'bio' => [
            '_' => 'Bio',
            'tooltip' => 'Describe youself! (Markdown enabled)'
        ],
        'username' => [
            '_' => 'Username',
            'tooltip' => 'It must be unique, alphanumeric. Warning! Your old username is available immediately after change! Keep in mind that this could break some Akmey clients.'
        ],
        'email' => [
            '_' => 'E-Mail',
            'tooltip' => 'If you change the e-mail, you need to confirm the new address before using it.'
        ],
        'newpasswd' => [
            '_' => 'New Password',
            'tooltip' => 'Choose a faster, stronger, better password! (8 chars min.)'
        ],
        'oldpasswd' => [
            '_' => 'Old Password',
            'tooltip' => 'Please retype your password for any change.'
        ],
        'save' => 'Save',
        'page' => 'Profile page'
    ],

    'oauth' => [
        'apps' => [
            '_' => 'Authorized Applications',
            'table' => [
                'name' => 'Name',
                'scopes' => 'Scopes',
                'revoke' => 'Revoke'
            ]
        ],
        'dev' => [
            '_' => 'Developer',
            'clients' => [
                '_' => 'OAuth Clients',
                'none' => 'You have not created any OAuth clients.',
                'table' => [
                    'id' => 'Client ID',
                    'name' => 'Name',
                    'secret' => 'Secret',
                    'edit' => 'Edit',
                    'delete' => 'Delete'
                ],
                'form' => [
                    '_' => 'Create Client',
                    'edit' => 'Edit Client',
                    'name' => [
                        '_' => 'Name',
                        'tooltip' => 'Something your users will recognize and trust.'
                    ],
                    'redirect' => [
                        '_' => 'Redirect URL',
                        'tooltip' => 'Your application\'s authorization callback URL.'
                    ],
                    'close' => 'Close',
                    'create' => 'Create',
                    'save' => 'Save changes',
                    'err' => [
                        'title' => 'Whoops!',
                        'sub' => 'Something went wrong!'
                    ]
                ],
                'add' => 'Create New Client'
            ],
            'pat' => [
                '_' => 'Personal Access Tokens',
                'none' => 'You have not created any personal access tokens.',
                'name' => 'Name',
                'form' => [
                    '_' => 'Create Token',
                    'create' => 'Create',
                    'name' => 'Name',
                    'close' => 'Close',
                    'created' => 'Here is your new personal access token. This is the only time it will be shown so don\'t lose it! You may now use this token to make API requests.',
                    'scopes' => 'Scopes',
                    'pat' => 'Personal Access Token',
                    'err' => [
                        'title' => 'Whoops!',
                        'sub' => 'Something went wrong!'
                    ]
                ],
                'table' => [
                    'name' => 'Name',
                    'delete' => 'Delete'
                ],
                'add' => 'Create New Token'
            ]
        ]
    ],

    'github' => [
        'title' => 'Great!',
        'head' => 'Now choose the keys you want to import.',
        'btn' => 'Import!'
    ]

];
