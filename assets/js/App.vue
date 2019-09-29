<template>
    <v-app>

    </v-app>

</template>

<script>
    import User from "./user";
    import 'vuetify/dist/vuetify.min.css'
    import '@mdi/font/css/materialdesignicons.css'
    export default {
        name: "HelloWorld",
        show: true,
        data: () => ({
            alert:true,
            message:'Bienvenue',
            user: new User()
        }),
        methods: {
        }
    };
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
