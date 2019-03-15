<template>
    <div class="ui container" id="stories">
    </div>
</template>

<script>
    const Zuck = require('zuck.js');

    export default {
        props: ['keyinput', 'csrf'],

        /**
         * Prepare the component (Vue 1.x).
         */
        ready() {
            this.prepareComponent();
        },

        /**
         * Prepare the component (Vue 2.x).
         */
        mounted() {
            this.prepareComponent();
        },

        methods: {
            prepareComponent: function() {
                this.zuck = new Zuck('stories', {
                    id: '1',         // timeline container id or reference
                    skin: 'snapgram',      // container class
                    avatars: true,         // shows user photo instead of last story item preview
                    list: false,           // displays a timeline instead of carousel
                    openEffect: true,      // enables effect when opening story - may decrease performance
                    cubeEffect: false,     // enables the 3d cube effect when sliding story - may decrease performance
                    autoFullScreen: false, // enables fullscreen on mobile browsers
                    backButton: true,      // adds a back button to close the story viewer
                    backNative: false,     // uses window history to enable back button on browsers/android
                    previousTap: true,     // use 1/3 of the screen to navigate to previous item when tap the story

                    stories: [             // array of stories
                        {
                            id: '1',
                            photo: '/storage/default.jpg',
                            name: 'Stories!',
                            lastUpdated: '2',
                            items: [
                                {
                                    id: '1',
                                    type: 'photo',
                                    length: 6,
                                    src: 'https://a.wattpad.com/cover/147122863-352-k276977.jpg',
                                    link: 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                                    linkText: 'More +'
                                }
                            ]
                        }
                    ],

                    callbacks:  {
                        'onOpen': function(storyId, callback) { // on open story viewer
                            callback();
                        },

                        'onView': function(storyId) { // on view story

                        },

                        'onEnd': function(storyId, callback) { // on end story
                            callback();
                        },

                        'onClose': function(storyId, callback) { // on close story viewer
                            callback();
                        },

                        'onNavigateItem': function(storyId, nextStoryId, callback) { // on navigate item of story
                            callback();
                        },
                    },

                    'language': { // if you need to translate :)
                        'unmute': 'Touch to unmute',
                        'keyboardTip': 'Press space to see next',
                        'visitLink': 'Visit link',
                        'time': {
                            'ago':'ago',
                            'hour':'hour',
                            'hours':'hours',
                            'minute':'minute',
                            'minutes':'minutes',
                            'fromnow': 'from now',
                            'seconds':'seconds',
                            'yesterday': 'yesterday',
                            'tomorrow': 'tomorrow',
                            'days':'days'
                        }
                    }
                });
            }
        }
    }
</script>
