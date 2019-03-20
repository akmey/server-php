<template>
    <a @click.prevent="deleteAccountSubmit" href="#" class="ui red button">{{ lang.get('dashboard.settings.delete._') }}<br/>{{ lang.get('dashboard.settings.delete.tooltip') }}</a>
</template>

<script>
    import swal from 'sweetalert';

    export default {
        props: ['lang'],
        methods: {
            deleteAccountSubmit() {
                swal({
                    title: this.lang.get('dashboard.settings.delete.one.title'),
                    text: this.lang.get('dashboard.settings.delete.one.text'),
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        fetch('/delete-account').then(res => {
                            if (!res.ok) return false;
                            swal(this.lang.get('dashboard.settings.delete.two'), {
                                icon: "success",
                            }).then(val => {
                                window.location.assign('/');
                            });
                        });
                        return;
                    }
                });
            }
        }
    }
</script>
