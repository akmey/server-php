<template>
    <div class="item" :data-clipboard-text="content + ' ' + comment" :id="comment" @click="notification()">
        <i class="key icon"></i>
        <div class="content">
            <div class="header">{{ comment }}</div>
            <div class="description break">{{ content.substr(0, 50) }}...</div>
        </div>
    </div>
</template>

<script>
import ClipboardJS from 'clipboard';
import Noty from 'noty';

export default {
    props: ['comment', 'content', 'lang'],

    methods: {
        notification() {
            new Noty({
                type: 'success',
                layout: 'topRight',
                theme: 'metroui',
                timeout: 2500,
                text: '<i class="check icon"></i> ' + this.lang.get('profile.copied')
            }).show();
        }
    },

    mounted() {
        new ClipboardJS('#'+this.comment);
    }
}
</script>
