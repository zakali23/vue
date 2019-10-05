<template>
    <v-app>
        <v-btn @click="viewContent()">tester</v-btn>
    </v-app>

</template>

<script>
    import User from "./user";
    import axios from 'axios';
    import 'vuetify/dist/vuetify.min.css'
    import '@mdi/font/css/materialdesignicons.css'
    import commune from "./commune.json"
    export default {
        name: "HelloWorld",
        show: true,
        data: () => ({
            alert:true,
            message:'Bienvenue',
            user: new User()
        }),
        methods: {
            viewContent(){
              /* //let vr = 0
                commune.forEach(function(data) {
                    axios({
                        method: 'post',
                        url: 'http://127.0.0.1:8000/commune/new',
                        data: data
                    }).then(function (response) {
                           console.log(response.data)
                          //  vr ++
                    });
                   // console.log(vr)
                });*/
               // console.log(commune.length)
                axios({
                    method: 'post',
                    url: 'http://localhost:8000/commune/new',
                    data: commune
                }).then(function (response) {
                    console.log(response.data)
                });


            }
        }
    };
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
