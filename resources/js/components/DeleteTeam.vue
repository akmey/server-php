<template>
    <a @click.prevent="deleteSubmit" href="#" class="ui orange button">{{ lang.get('team.form.delete.btn') }}</a>
</template>

<script>
    import swal from 'sweetalert';

    export default {
        props: ['teamid', 'lang'],
        methods: {
            deleteSubmit() {
                swal({
                    title: this.lang.get('team.form.delete.one.title'),
                    text: this.lang.get('team.form.delete.one.desc'),
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        fetch('/team/delete/' + this.teamid).then(res => {
                            if (!res.ok) return false;
                            swal(this.lang.get('team.form.delete.two'), {
                                icon: "success",
                            }).then(val => {
                                window.location.assign('/dashboard');
                            });
                        });
                        return;
                    }
                });
            }
        }
    }
</script>
