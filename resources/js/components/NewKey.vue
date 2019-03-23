<template>
    <form @submit.prevent="sendForm">
        <div class="ui fluid labeled input">
            <div class="ui label">
                {{ lang.get('dashboard.newkey._') }}
            </div>
            <input name="key" v-model="keyinput" class="form-control" :aria-label="lang.get('dashboard.newkey.aria')"></input>
        </div>
        <input type="hidden" name="_token" :value="csrf">
    </form>
</template>

<script>
    import Noty from "noty";

    export default {
        props: ['lang', 'csrf'],
        data: function () {
            return {
                keyinput: ''
            }
        },
        methods: {
            sendForm: function(e) {
                if (!this.keyinput) {
                    new Noty({
                        type: 'error',
                        layout: 'topCenter',
                        theme: 'metroui',
                        timeout: 2500,
                        text: '<i class="exclamation triangle icon"></i> ' + this.lang.get('dashboard.newkey.err.empty')
                    }).show();
                    return false;
                }
                var regex = /^ssh-(?:[0-9a-z]){2,} [\S]{12,}$/;
                if (!regex.test(this.keyinput)) {
                    new Noty({
                        type: 'error',
                        layout: 'topCenter',
                        theme: 'metroui',
                        timeout: 2500,
                        text: '<i class="exclamation triangle icon"></i> ' + this.lang.get('dashboard.newkey.err.malformed')
                    }).show();
                    return false;
                }
                axios.post('/addkey', {key: this.keyinput}).then(response => {
                    window.location.reload();
                    return true;
                }).catch(error => {
                    new Noty({
                        type: 'error',
                        layout: 'topCenter',
                        theme: 'metroui',
                        timeout: 2500,
                        text: '<i class="exclamation triangle icon"></i> ' + this.lang.get('dashboard.newkey.err.neterr')
                    }).show();
                    return false;
                });
            }
        }
    }
</script>
