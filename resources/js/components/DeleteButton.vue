<template>
    <a @click.prevent="deleteSubmit" href="#" class="ui orange button">{{ lang.get('dashboard.edit.delete') }}</a>
</template>

<script>
    import swal from 'sweetalert';

    export default {
        props: ['keyid', 'lang'],
        methods: {
            deleteSubmit() {
                swal({
                    title: this.lang.get('dashboard.edit.popup.one.title'),
                    text: this.lang.get('dashboard.edit.popup.one.desc'),
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        fetch('/delete/' + this.keyid).then(res => {
                            if (!res.ok) return false;
                            swal(this.lang.get('dashboard.edit.popup.two'), {
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
