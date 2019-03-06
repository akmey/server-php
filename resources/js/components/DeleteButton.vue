<template>
    <a @click.prevent="deleteSubmit" href="#" class="ui red button">Delete</a>
</template>

<script>
    import swal from 'sweetalert';

    export default {
        props: ['keyid'],
        methods: {
            deleteSubmit() {
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, the key will be removed from Akmey server.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        fetch('/delete/' + this.keyid).then(res => {
                            if (!res.ok) return false;
                            swal("That's it, your key will disappear from servers in a while.", {
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
