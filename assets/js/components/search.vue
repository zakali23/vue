<template>
    <v-app id="inspire" >
        <v-card flat>
            <v-toolbar
                    color="transparent"
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
                            color="white"

                    ></v-autocomplete >
                    <v-btn icon>
                        <v-icon @click.prevent="showResult" color="#F5DEB3">mdi-magnify</v-icon>
                    </v-btn>

                </v-toolbar>

                <v-divider></v-divider>
                <transition name="fade">
                <v-card-text style="height: auto;" v-if="show" >
                <resultats :ville="commune.name"
                           :temperature="commune.temp"
                           :description="commune.desc"
                           :icon="commune.icon"
                           :vent="commune.vent"
                           :humidity="commune.humidity"
                           :coord="commune.coord"
                           :min="commune.min"
                           :max="commune.max"/>
                </v-card-text>
                </transition>
            </v-card>
        </v-card>
        <v-snackbar
                v-model="snackbar"
                bottom

        >
            {{ error }}
            <v-btn
                    color="red"
                    text
                    @click="snackbar = false"
            >
                Fermer
            </v-btn>
        </v-snackbar>
    </v-app>
</template>
<script>

    import resultats from './resultats.vue'
    import store from '../stores/store'
    export default {
        store,
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
                icon:'01d',
                coord:[],
                min:null,
                max:null
            },
            villes:[],
            loading:false,
            search:null,
            error:"Malheureusement, la ville demandée n'est pas disponible  ",
            snackbar:false


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

                }).finally(function () {
                    self.loading = false
                });
            },
            showResult() {
                const url = `http://api.openweathermap.org/data/2.5/weather?q=${this.commune.name}&lang=fr&units=metric&appid=aeaa755359f4760cc69052fa33cbb13c`
                    let self = this
                    this.axios({
                        method: 'get',
                        url: url
                    })
                        .then(function (response) {
                             console.log(response.data.weather[0].icon)
                            self.commune.name = response.data.name
                            self.commune.desc = response.data.weather[0].description
                            self.commune.temp = Math.round(response.data.main.temp)
                            self.commune.humidity = Math.round(response.data.main.humidity)
                            self.commune.vent = response.data.wind.speed,
                            self.commune.coord = [response.data.coord.lat,response.data.coord.lon]
                            self.commune.min = response.data.main.temp_min;
                            self.commune.max = response.data.main.temp_max;
                            if(response.data.weather[0].icon ==="01n"){
                                self.commune.icon ="https://cdn2.iconfinder.com/data/icons/crystalproject/crystal_project_256x256/apps/kweather.png"
                            }
                            else{
                                self.commune.icon = 'http://openweathermap.org/img/wn/'+response.data.weather[0].icon+'@2x.png'
                            }
                            store.commit('setShow',true)
                        }).catch(function (error) {
                           //console.log(error.response.data);
                           store.commit('setShow',false)
                            self.snackbar = true
                         }).finally(function () {

                    });





            }
        },
        computed:{
            show(){
                return store.getters.getShow;
            }
        }

    }
</script>

<style scoped>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .2s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
    }

</style>