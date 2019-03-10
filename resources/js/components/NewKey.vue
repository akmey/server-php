<template>
    <form @submit.prevent="sendForm">
        <div class="ui fluid labeled input">
            <div class="ui label">
                New key
            </div>
            <input name="key" v-model="keyinput" class="form-control" aria-label="New key (paste it without comments)"></input>
        </div>
        <input type="hidden" name="_token" :value="csrf">
    </form>
</template>

<script>
    export default {
        props: ['keyinput', 'csrf'],
        /*data: function () {
            return {
                keyinput: this.keyinput
            }
        },*/
        methods: {
            sendForm: function(e) {
                if (!this.keyinput) { alert('Key is empty'); return false; }
                var regex = /^ssh-(?:[0-9a-z]){2,} [\S]{12,}$/;
                if (!regex.test(this.keyinput)) { alert('Key is malformed'); return false; }
                var body = 'key='+encodeURIComponent(this.keyinput);
                var headers = new Headers();
                headers.append('Accept', 'application/json');
                headers.append('X-CSRF-TOKEN', this.csrf);
                headers.append('Content-Type', 'application/x-www-form-urlencoded');
                fetch('/addkey', {
                    method: 'POST',
                    headers,
                    body
                }).then(response => {
                    if (!response.ok) {
                        alert('Cannot add your key, it may be already used.');
                        return false;
                    } else {
                        window.location.reload();
                        return true;
                    }
                })
            }
        }
    }
</script>
