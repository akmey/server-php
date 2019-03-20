<template>
    <div>
        <div class="ui top attached tabular menu" v-bind:class="{ inverted: dark }">
            <span class="active item">
                {{ lang.get('dashboard.oauth.dev.clients._') }}
            </span>

            <div class="right menu">
                <div class="item">
                    <a class="ui labeled icon primary button" @click="showCreateClientForm">
                        <i class="plus icon"></i>
                        {{ lang.get('dashboard.oauth.dev.clients.add') }}
                    </a>
                </div>
            </div>
        </div>
        <div class="ui bottom attached segment" v-bind:class="{ inverted: dark }">
            <!-- Current Clients -->
            <p v-if="clients.length === 0">
                {{ lang.get('dashboard.oauth.dev.clients.none') }}
            </p>

            <table class="ui celled table" v-bind:class="{ inverted: dark }" v-if="clients.length > 0">
                <thead>
                    <tr>
                        <th>{{ lang.get('dashboard.oauth.dev.clients.table.id') }}</th>
                        <th>{{ lang.get('dashboard.oauth.dev.clients.table.name') }}</th>
                        <th>{{ lang.get('dashboard.oauth.dev.clients.table.secret') }}</th>
                        <th><i class="edit icon"></i></th>
                        <th><i class="delete icon"></i></th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="client in clients">
                        <!-- ID -->
                        <td style="vertical-align: middle;">
                            {{ client.id }}
                        </td>

                        <!-- Name -->
                        <td style="vertical-align: middle;">
                            {{ client.name }}
                        </td>

                        <!-- Secret -->
                        <td style="vertical-align: middle;">
                            <code>{{ client.secret }}</code>
                        </td>

                        <!-- Edit Button -->
                        <td style="vertical-align: middle;">
                            <a class="ui primary button" tabindex="-1" @click="edit(client)">
                                {{ lang.get('dashboard.oauth.dev.clients.table.edit') }}
                            </a>
                        </td>

                        <!-- Delete Button -->
                        <td style="vertical-align: middle;">
                            <a class="ui red button" @click="destroy(client)">
                                {{ lang.get('dashboard.oauth.dev.clients.table.delete') }}
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Create Client Modal -->
        <div class="ui small basic modal" id="modal-create-client" role="dialog">
            <div class="header">
                {{ lang.get('dashboard.oauth.dev.clients.form._') }}
            </div>
            <div class="content">
                <!-- Form Errors -->
                <div class="ui error message" v-if="createForm.errors.length > 0">
                    <div class="header"><strong>{{ lang.get('dashboard.oauth.dev.clients.form.err.title') }}</strong> {{ lang.get('dashboard.oauth.dev.clients.form.err.sub') }}</div>
                    <ul>
                        <li v-for="error in createForm.errors">
                            {{ error }}
                        </li>
                    </ul>
                </div>

                <!-- Create Client Form -->
                <form class="ui form" role="form">
                    <!-- Name -->
                    <div class="field">
                        <label for="create-client-name">{{ lang.get('dashboard.oauth.dev.clients.form.name._') }}</label>
                        <input id="create-client-name" type="text"
                                                    @keyup.enter="store" v-model="createForm.name">

                        <small>
                            {{ lang.get('dashboard.oauth.dev.clients.form.name.tooltip') }}
                        </small>
                    </div>

                    <!-- Redirect URL -->
                    <div class="field">
                        <label for="redirect">{{ lang.get('dashboard.oauth.dev.clients.form.redirect._') }}</label>
                        <input type="text" class="form-control" name="redirect"
                                        @keyup.enter="store" v-model="createForm.redirect">

                        <small>
                            {{ lang.get('dashboard.oauth.dev.clients.form.redirect.tooltip') }}
                        </small>
                    </div>
                </form>
            </div>

            <!-- Modal Actions -->
            <div class="actions">
                <button type="button" class="ui red deny button" data-dismiss="modal">{{ lang.get('dashboard.oauth.dev.clients.form.close') }}</button>

                <button type="button" class="ui primary button" @click="store">
                    {{ lang.get('dashboard.oauth.dev.clients.form.create') }}
                </button>
            </div>
        </div>


        <!-- Edit Client Modal -->
        <div class="ui small basic modal" id="modal-edit-client" role="dialog">
            <div class="header">
                {{ lang.get('dashboard.oauth.dev.clients.form.edit') }}
            </div>
            <div class="content">
                <!-- Form Errors -->
                <div class="ui error message" v-if="editForm.errors.length > 0">
                    <div class="header"><strong>{{ lang.get('dashboard.oauth.dev.clients.form.err.title') }}</strong> {{ lang.get('dashboard.oauth.dev.clients.form.err.sub') }}</div>
                    <ul>
                        <li v-for="error in editForm.errors">
                            {{ error }}
                        </li>
                    </ul>
                </div>

                <!-- Edit Client Form -->
                <form class="ui form" role="form">
                    <!-- Name -->
                    <div class="field">
                        <label for="edit-client-name">{{ lang.get('dashboard.oauth.dev.clients.form.name._') }}</label>
                        <input id="edit-client-name" type="text"
                                                    @keyup.enter="update" v-model="editForm.name">

                        <small>
                            {{ lang.get('dashboard.oauth.dev.clients.form.name.tooltip') }}
                        </small>
                    </div>

                    <!-- Redirect URL -->
                    <div class="field">
                        <label for="redirect">{{ lang.get('dashboard.oauth.dev.clients.form.redirect._') }}</label>
                        <input type="text" name="redirect"
                                        @keyup.enter="update" v-model="editForm.redirect">

                        <span class="form-text text-muted">
                            {{ lang.get('dashboard.oauth.dev.clients.form.redirect.tooltip') }}
                        </span>
                    </div>
                </form>
            </div>

            <!-- Modal Actions -->
            <div class="actions">
                <button type="button" class="ui red deny button" data-dismiss="modal">{{ lang.get('dashboard.oauth.dev.clients.form.close') }}</button>

                <button type="button" class="ui primary button" @click="update">
                   {{ lang.get('dashboard.oauth.dev.clients.form.save') }}
                </button>
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
                clients: [],

                createForm: {
                    errors: [],
                    name: '',
                    redirect: ''
                },

                editForm: {
                    errors: [],
                    name: '',
                    redirect: ''
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
                this.getClients();

                $('#modal-create-client').on('shown.bs.modal', () => {
                    $('#create-client-name').focus();
                });

                $('#modal-edit-client').on('shown.bs.modal', () => {
                    $('#edit-client-name').focus();
                });
            },

            /**
             * Get all of the OAuth clients for the user.
             */
            getClients() {
                axios.get('/oauth/clients')
                        .then(response => {
                            this.clients = response.data;
                        });
            },

            /**
             * Show the form for creating new clients.
             */
            showCreateClientForm() {
                $('#modal-create-client').modal('show');
            },

            /**
             * Create a new OAuth client for the user.
             */
            store() {
                this.persistClient(
                    'post', '/oauth/clients',
                    this.createForm, '#modal-create-client'
                );
            },

            /**
             * Edit the given client.
             */
            edit(client) {
                this.editForm.id = client.id;
                this.editForm.name = client.name;
                this.editForm.redirect = client.redirect;

                $('#modal-edit-client').modal('show');
            },

            /**
             * Update the client being edited.
             */
            update() {
                this.persistClient(
                    'put', '/oauth/clients/' + this.editForm.id,
                    this.editForm, '#modal-edit-client'
                );
            },

            /**
             * Persist the client to storage using the given form.
             */
            persistClient(method, uri, form, modal) {
                form.errors = [];

                axios[method](uri, form)
                    .then(response => {
                        this.getClients();

                        form.name = '';
                        form.redirect = '';
                        form.errors = [];

                        $(modal).modal('hide');
                    })
                    .catch(error => {
                        if (typeof error.response.data === 'object') {
                            form.errors = _.flatten(_.toArray(error.response.data.errors));
                        } else {
                            form.errors = ['Something went wrong. Please try again.'];
                        }
                    });
            },

            /**
             * Destroy the given client.
             */
            destroy(client) {
                axios.delete('/oauth/clients/' + client.id)
                        .then(response => {
                            this.getClients();
                        });
            }
        }
    }
</script>
