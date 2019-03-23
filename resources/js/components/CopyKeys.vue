<template>
    <div class="item" @click="notification()" id="copy" :data-clipboard-text="content">
        <i class="key icon"></i>
        <div class="content">
            <a class="header" href="#">{{ lang.get('profile.copy._') }}</a>
            <div class="description break">{{ lang.get('profile.copy.desc', {'user': user}) }}</div>
        </div>
    </div>
</template>

<script>
import ClipboardJS from 'clipboard';
import Noty from 'noty';

export default {
    props: ['content', 'lang', 'user'],

    methods: {
        notification() {
            new Noty({
                type: 'success',
                layout: 'topRight',
                theme: 'metroui',
                timeout: 2500,
                text: '<i class="check icon"></i> ' + this.lang.get('profile.copiedplural')
            }).show();
        }
    },

    mounted() {
        new ClipboardJS('#copy');
    }
}
</script>
