<template>
    <v-app>
      <search/>
    </v-app>

</template>

<script>
    import axios from 'axios';
    import 'vuetify/dist/vuetify.min.css'
    import '@mdi/font/css/materialdesignicons.css'
    import search from './components/search.vue'
    export default {
        name: "HelloWorld",
        components:{
            search
        },
        data: () => ({

        }),
        methods: {

        }
    };
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
