<template>
    <a @click.prevent="deleteAccountSubmit" href="#" class="btn btn-danger">Delete my account<br/><span class="badge badge-warning">This will delete all your account data from this server.</span></a>
</template>

<script>
    import swal from 'sweetalert';

    export default {
        methods: {
            deleteAccountSubmit() {
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, your account and your keys will be removed from Akmey server.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        fetch('/delete-account').then(res => {
                            if (!res.ok) return false;
                            swal("That's it, your account will disappear from servers in a while.", {
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
