<template>
    <div>
        <div v-if="tokens.length > 0">
            <div class="ui segment" v-bind:dark="dark">
                <h3 class="ui header">Authorized Applications</h3>
                <!-- Authorized Tokens -->
                <table class="ui celled table" v-bind:dark="dark">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Scopes</th>
                            <th><i class="remove icon"></i></th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="token in tokens">
                            <!-- Client Name -->
                            <td>
                                {{ token.client.name }}
                            </td>

                            <!-- Scopes -->
                            <td>
                                <span v-if="token.scopes.length > 0">
                                    {{ token.scopes.join(', ') }}
                                </span>
                            </td>

                            <!-- Revoke Button -->
                            <td>
                                <a class="ui red button" @click="revoke(token)">
                                    Revoke
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['dark'],
        /*
         * The component's data.
         */
        data() {
            return {
                tokens: []
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
             * Prepare the component (Vue 2.x).
             */
            prepareComponent() {
                this.getTokens();
            },

            /**
             * Get all of the authorized tokens for the user.
             */
            getTokens() {
                axios.get('/oauth/tokens')
                        .then(response => {
                            this.tokens = response.data;
                        });
            },

            /**
             * Revoke the given token.
             */
            revoke(token) {
                axios.delete('/oauth/tokens/' + token.id)
                        .then(response => {
                            this.getTokens();
                        });
            }
        }
    }
</script>
