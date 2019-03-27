<template>
    <div class="ui secondary pointing menu" v-bind:class="{ inverted: dark }">
        <a class="item" v-bind:class="{ active: activetab == 'keys' }" @click="setActiveTab('keys')">
            {{ this.lang.get('dashboard.menu.keys') }}
        </a>
        <a class="item" v-bind:class="{ active: activetab == 'teams' }" @click="setActiveTab('teams')">
            {{ this.lang.get('dashboard.menu.teams') }}
        </a>
        <div class="right menu">
            <a class="item" v-bind:class="{ active: activetab == 'oauth' }" @click="setActiveTab('oauth')">
                {{ this.lang.get('dashboard.menu.oauth') }}
            </a>
            <a class="item" v-bind:class="{ active: activetab == 'settings' }" @click="setActiveTab('settings')">
                {{ this.lang.get('dashboard.menu.settings') }}
            </a>
        </div>
    </div>
</template>

<script>
export default {
    props: ['lang', 'dark', 'activetab'],

    methods: {
        setActiveTab(tab) {
            this.$emit('change-tab', tab);
        }
    }
}
</script>
