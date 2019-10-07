<template>
    <v-app id="inspire" >
        <v-card flat>
            <v-toolbar
                    color="elevation-0"
                    dark
                    extended
                    flat

            >
                <v-app-bar-nav-icon></v-app-bar-nav-icon>
            </v-toolbar>

            <v-card
                    class="mx-auto"
                    max-width="700"
                    style="margin-top: -64px;"
            >
                <v-toolbar flat>
                    <v-toolbar-title class="grey--text"></v-toolbar-title>

                    <v-autocomplete
                            class="mx-4"
                            v-model="commune.name"
                            :loading="loading"
                            :items="villes"
                            :search-input.sync=" search"
                            cache-items
                            flat
                            hide-no-data
                            hide-details
                            label="Saisissez votre ville "
                            solo-inverted


                    ></v-autocomplete>
                    <v-btn icon>
                        <v-icon @click="showResult">mdi-magnify</v-icon>
                    </v-btn>

                </v-toolbar>

                <v-divider></v-divider>

                <v-card-text style="height: auto;" v-if="show">
                <resultats :ville="commune.name" :temperature="commune.temp" :description="commune.desc" :icon="commune.icon" :vent="commune.vent" :humidity="commune.humidity"/>
                </v-card-text>
            </v-card>
        </v-card>
    </v-app>
</template>
<script>

    import resultats from './resultats.vue'
    export default {
        components:{
            resultats
        },
       data () {
           return {
            commune:{
                name:null,
                temp:null,
                vent:null,
                desc:null,
                humidity:null,
                icon:null
            },
            villes:[],
            loading:false,
            search:null,
            show:false,

           }
       },
        watch:{
            search (val) {
                val && val !== this.commune.name && this.fetchCommune(val)
            }
        },
        methods:{
            fetchCommune (v) {
                this.loading = true
                const url = Routing.generate('commune_search',{search:v});
                let self = this
                this.axios({
                    method: 'get',
                    url: url
                }).then(function (response) {
                     self.villes = response.data

                }).catch(function (error) {
                    console.log(error.response);
                }).finally(function () {
                    self.loading = false
                });
            },
            showResult() {
                console.log('test')
                const url = `http://api.openweathermap.org/data/2.5/weather?q=${this.commune.name}&lang=fr&units=metric&appid=aeaa755359f4760cc69052fa33cbb13c`
                let self = this
                this.axios({
                    method: 'get',
                    url: url
                }).then(function (response) {
                  console.log(response.data)
                    self.commune.name = response.data.name
                    self.commune.desc = response.data.weather[0].description
                    self.commune.icon = response.data.weather[0].icon
                    self.commune.temp = Math.round(response.data.main.temp)
                    self.commune.humidity = Math.round(response.data.main.humidity)
                    self.commune.vent = response.data.wind.speed
                    console.log(self.commune.desc)
                }).catch(function (error) {
                    console.log(error.response);
                }).finally(function () {
                    self.show = true;
                });

            }
        }

    }
</script>

<style scoped>

</style>