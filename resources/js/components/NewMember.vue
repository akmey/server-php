<template>
    <form @submit.prevent="sendForm">
        <div class="ui fluid labeled input">
            <div class="ui label">
                {{ lang.get('team.newmember.label') }}
            </div>
            <input name="member" v-model="userinput" :aria-label="lang.get('team.newmember.aria')"></input>
        </div>
    </form>
</template>

<script>
    import Noty from "noty";

    export default {
        props: ['lang', 'teamid'],
        data: function () {
            return {
                userinput: ''
            }
        },
        methods: {
            sendForm: function(e) {
                if (!this.userinput) {
                    new Noty({
                        type: 'error',
                        layout: 'topCenter',
                        theme: 'metroui',
                        timeout: 2500,
                        text: '<i class="exclamation triangle icon"></i> ' + this.lang.get('team.newmember.err.empty')
                    }).show();
                    return false;
                }
                axios.post('/team/admin/'+this.teamid+'/addmember', {username: this.userinput}).then(response => {
                    new Noty({
                        type: 'success',
                        layout: 'topCenter',
                        theme: 'metroui',
                        timeout: 2500,
                        text: '<i class="user plus icon"></i> ' + this.lang.get('team.newmember.success')
                    }).show();
                    return true;
                }).catch(error => {
                    console.error(error.response.data);
                    new Noty({
                        type: 'error',
                        layout: 'topCenter',
                        theme: 'metroui',
                        timeout: 2500,
                        text: '<i class="exclamation triangle icon"></i> ' + this.lang.get('team.newmember.err.'+error.response.data)
                    }).show();
                    return false;
                });
            }
        }
    }
</script>
