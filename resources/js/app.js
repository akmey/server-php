
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');
require('./semantic');
window.axios = require('axios');
window.Lang = require('lang.js');

window.Vue = require('vue');

import * as Sentry from '@sentry/browser';

if (process.env.MIX_SENTRY_DSN != 'null') {
    Sentry.init({
        dsn: process.env.MIX_SENTRY_DSN,
        integrations: [new Sentry.Integrations.Vue({
            Vue: window.Vue,
            attachProps: true
        })]
    });
}

/* global Vue, $, axios, Lang*/

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component(
    'delete-button',
    require('./components/DeleteButton.vue').default
);

Vue.component(
    'delete-account',
    require('./components/DeleteAccount.vue').default
);

Vue.component(
    'delete-team',
    require('./components/DeleteTeam.vue').default
);

Vue.component(
    'new-key',
    require('./components/NewKey.vue').default
);

Vue.component(
    'new-member',
    require('./components/NewMember.vue').default
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

Vue.component(
    'key',
    require('./components/Key').default
);

Vue.component(
    'copykeys',
    require('./components/CopyKeys').default
);

Vue.component(
    'dashboard-menu',
    require('./components/DashboardMenu').default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({ // eslint-disable-line no-unused-vars
    el: '#app',
    data: {
        dark: false,
        messages: {},
        activeTab: 'keys',
        lang: null
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
        },
        setTab: function(tab) {
            this.activeTab = tab;
            history.pushState({tab}, process.env.MIX_APP_NAME, '/dashboard/'+tab);
        }
    },
    beforeCreate: function() {
        axios.get('/locale.json').then(response => {
            this.messages = response.data;
            this.lang = new Lang({
                messages: this.messages,
                locale: this.messages.defaultlang,
                fallback: 'en',
            });
            return true;
        }).catch(err => {
            throw new Error(err);
        });
        return true;
    },
    beforeMount: function() {
        var tab = $('meta[name=activeTab]').attr('content');
        if (tab) this.activeTab = tab;
    }
});

$().ready(() => {
    $('.ui.dropdown').dropdown();
    $('.ui.checkbox').checkbox();
});
