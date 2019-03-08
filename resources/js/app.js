
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');
require('./semantic');

window.Vue = require('vue');
/* global Vue, $ */

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component(
    'delete-button',
    require('./components/DeleteButton.vue').default
);

Vue.component(
    'delete-account',
    require('./components/DeleteAccount.vue').default
);

Vue.component(
    'new-key',
    require('./components/NewKey.vue').default
);

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);

Vue.component(
    'dark-button',
    require('./components/DarkButton').default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({ // eslint-disable-line no-unused-vars
    el: '#app',
    data: {
        dark: false
    },
    methods: {
        switchTheme: function(dark) {
            if (dark) {
                this.dark = true;
                $('body').addClass('darkbg');
            } else {
                this.dark = false;
                $('body').removeClass('darkbg');
            }
        }
    }
});

$().ready(() => {
    $('.ui.dropdown').dropdown();
});
