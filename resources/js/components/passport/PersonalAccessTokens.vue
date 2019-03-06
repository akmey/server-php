<style scoped>
    .action-link {
        cursor: pointer;
    }
</style>

<template>
    <div>
        <div class="ui top attached tabular menu">
            <span class="active item">
                Personal Access Tokens
            </span>

            <div class="right menu">
                <div class="item">
                    <a class="ui labeled icon primary button" @click="showCreateTokenForm">
                        <i class="plus icon"></i>
                        Create New Token
                    </a>
                </div>
            </div>
        </div>
        <div class="ui bottom attached segment">
            <!-- No Tokens Notice -->
            <p v-if="tokens.length === 0">
                You have not created any personal access tokens.
            </p>

            <!-- Personal Access Tokens -->
            <table class="ui celled table" v-if="tokens.length > 0">
                <thead>
                    <tr>
                        <th>Name</th>
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
                                Delete
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Create Token Modal -->
        <div class="ui small modal" id="modal-create-token" tabindex="-1" role="dialog">
            <div class="header">
                Create Token
            </div>

            <div class="content">
                <!-- Form Errors -->
                <div class="ui error message" v-if="form.errors.length > 0">
                    <div class="header"><strong>Whoops!</strong> Something went wrong!</div>
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
                        <label for="create-token-name">Name</label>
                        <input id="create-token-name" type="text" name="name" v-model="form.name">
                    </div>

                    <!-- Scopes -->
                    <div v-if="scopes.length > 0">
                        <label>Scopes</label>

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
                <button type="button" class="ui deny red button" data-dismiss="modal">Close</button>

                <button type="button" class="ui blue button" @click="store">
                    Create
                </button>
            </div>
        </div>

        <!-- Access Token Modal -->
        <div class="ui modal" id="modal-access-token" role="dialog">
            <div class="header">
                Personal Access Token
            </div>

            <div class="content">
                <p>
                    Here is your new personal access token. This is the only time it will be shown so don't lose it!
                    You may now use this token to make API requests.
                </p>
                <form class="ui form" @submit.prevent="false">
                    <div class="field">
                        <textarea rows="10">{{ accessToken }}</textarea>
                    </div>
                </form>
            </div>

            <!-- Modal Actions -->
            <div class="actions">
                <button type="button" class="ui red deny button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
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
