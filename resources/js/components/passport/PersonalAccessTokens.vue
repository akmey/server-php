<template>
    <div>
        <div class="ui top attached tabular menu" v-bind:class="{ inverted: dark }">
            <span class="active item">
                {{ lang.get('dashboard.oauth.dev.pat._') }}
            </span>

            <div class="right menu">
                <div class="item">
                    <a class="ui labeled icon primary button" @click="showCreateTokenForm">
                        <i class="plus icon"></i>
                        {{ lang.get('dashboard.oauth.dev.pat.add') }}
                    </a>
                </div>
            </div>
        </div>
        <div class="ui bottom attached segment" v-bind:class="{ inverted: dark }">
            <!-- No Tokens Notice -->
            <p v-if="tokens.length === 0">
                {{ lang.get('dashboard.oauth.dev.pat.none') }}
            </p>

            <!-- Personal Access Tokens -->
            <table class="ui celled table" v-bind:class="{ inverted: dark }" v-if="tokens.length > 0">
                <thead>
                    <tr>
                        <th>{{ lang.get('dashboard.oauth.dev.pat.table.name') }}</th>
                        <th><i class="delete icon"></i></th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="token in tokens">
                        <!-- Client Name -->
                        <td style="vertical-align: middle;">
                            {{ token.name }}
                        </td>

                        <!-- Delete Button -->
                        <td style="vertical-align: middle;">
                            <a class="ui red button" @click="revoke(token)">
                                {{ lang.get('dashboard.oauth.dev.pat.table.delete') }}
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Create Token Modal -->
        <div class="ui small basic modal" id="modal-create-token" tabindex="-1" role="dialog">
            <div class="header">
                {{ lang.get('dashboard.oauth.dev.pat.form._') }}
            </div>

            <div class="content">
                <!-- Form Errors -->
                <div class="ui error message" v-if="form.errors.length > 0">
                    <div class="header"><strong>{{ lang.get('dashboard.oauth.dev.pat.form.err.title') }}</strong> {{ lang.get('dashboard.oauth.dev.pat.form.err.sub') }}</div>
                    <ul>
                        <li v-for="error in form.errors">
                            {{ error }}
                        </li>
                    </ul>
                </div>

                <!-- Create Token Form -->
                <form role="form" @submit.prevent="store" class="ui form">
                    <!-- Name -->
                    <div class="field">
                        <label for="create-token-name">{{ lang.get('dashboard.oauth.dev.pat.form.name') }}</label>
                        <input id="create-token-name" type="text" name="name" v-model="form.name">
                    </div>

                    <!-- Scopes -->
                    <div v-if="scopes.length > 0">
                        <label>{{ lang.get('dashboard.oauth.dev.pat.form.scopes') }}</label>

                        <div class="grouped fields">
                            <div v-for="scope in scopes" class="field">
                                <div class="ui checkbox">
                                    <input type="checkbox"
                                        @click="toggleScope(scope.id)"
                                        :checked="scopeIsAssigned(scope.id)">

                                    <label>
                                        {{ scope.id }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Modal Actions -->
            <div class="actions">
                <button type="button" class="ui deny red button" data-dismiss="modal">{{ lang.get('dashboard.oauth.dev.pat.form.close') }}</button>

                <button type="button" class="ui blue button" @click="store">
                    {{ lang.get('dashboard.oauth.dev.pat.form.create') }}
                </button>
            </div>
        </div>

        <!-- Access Token Modal -->
        <div class="ui basic modal" id="modal-access-token" role="dialog">
            <div class="header">
                {{ lang.get('dashboard.oauth.dev.pat.form.pat') }}
            </div>

            <div class="content">
                <p>
                    {{ lang.get('dashboard.oauth.dev.pat.form.created') }}
                </p>
                <form class="ui form" @submit.prevent="false">
                    <div class="field">
                        <textarea rows="10">{{ accessToken }}</textarea>
                    </div>
                </form>
            </div>

            <!-- Modal Actions -->
            <div class="actions">
                <button type="button" class="ui red deny button" data-dismiss="modal">{{ lang.get('dashboard.oauth.dev.pat.form.close') }}</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['dark', 'lang'],
        /*
         * The component's data.
         */
        data() {
            return {
                accessToken: null,

                tokens: [],
                scopes: [],

                form: {
                    name: '',
                    scopes: [],
                    errors: []
                }
            };
        },

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
            /**
             * Prepare the component.
             */
            prepareComponent() {
                this.getTokens();
                this.getScopes();

                $('#modal-create-token').on('shown.bs.modal', () => {
                    $('#create-token-name').focus();
                });
                $('.ui.checkbox').checkbox();
            },

            /**
             * Get all of the personal access tokens for the user.
             */
            getTokens() {
                axios.get('/oauth/personal-access-tokens')
                        .then(response => {
                            this.tokens = response.data;
                        });
            },

            /**
             * Get all of the available scopes.
             */
            getScopes() {
                axios.get('/oauth/scopes')
                        .then(response => {
                            this.scopes = response.data;
                        });
            },

            /**
             * Show the form for creating new tokens.
             */
            showCreateTokenForm() {
                $('#modal-create-token').modal('show');
            },

            /**
             * Create a new personal access token.
             */
            store() {
                this.accessToken = null;

                this.form.errors = [];

                axios.post('/oauth/personal-access-tokens', this.form)
                        .then(response => {
                            this.form.name = '';
                            this.form.scopes = [];
                            this.form.errors = [];

                            this.tokens.push(response.data.token);

                            this.showAccessToken(response.data.accessToken);
                        })
                        .catch(error => {
                            if (typeof error.response.data === 'object') {
                                this.form.errors = _.flatten(_.toArray(error.response.data.errors));
                            } else {
                                this.form.errors = ['Something went wrong. Please try again.'];
                            }
                        });
            },

            /**
             * Toggle the given scope in the list of assigned scopes.
             */
            toggleScope(scope) {
                if (this.scopeIsAssigned(scope)) {
                    this.form.scopes = _.reject(this.form.scopes, s => s == scope);
                } else {
                    this.form.scopes.push(scope);
                }
            },

            /**
             * Determine if the given scope has been assigned to the token.
             */
            scopeIsAssigned(scope) {
                return _.indexOf(this.form.scopes, scope) >= 0;
            },

            /**
             * Show the given access token to the user.
             */
            showAccessToken(accessToken) {
                $('#modal-create-token').modal('hide');

                this.accessToken = accessToken;

                $('#modal-access-token').modal('show');
            },

            /**
             * Revoke the given token.
             */
            revoke(token) {
                axios.delete('/oauth/personal-access-tokens/' + token.id)
                        .then(response => {
                            this.getTokens();
                        });
            }
        }
    }
</script>
