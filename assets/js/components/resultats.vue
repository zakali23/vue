<template>
    <div>
            <v-card
                    class="mx-auto anime "
                    color="#F9F9F9"
            >
                <v-card-text :class="animation">
                    <v-list-item two-line :class="animation">
                        <template class="text-center">
                            <v-btn class="ma-2" tile x-large color="#F5DEB3" icon>
                                <v-icon>mdi-map-marker</v-icon>
                            </v-btn>
                        </template>

                        <v-list-item-content>
                            <v-list-item-title class="headline">{{ville.toUpperCase()}}</v-list-item-title>
                            <v-list-item-subtitle >{{date| moment("dddd,Do MMMM  YYYY")}}</v-list-item-subtitle>
                        </v-list-item-content>
                    </v-list-item>
                    <v-row align="center">
                        <v-col class="display-3 colory" cols="6">
                            {{temperature}}&deg;C
                        </v-col>
                        <v-col cols="6">
                            <v-img
                                    :src="icon"
                                    alt="Sunny image"
                                    width="90"
                            ></v-img>
                            <h1 class="colory">{{description}}</h1>
                        </v-col>
                    </v-row>
                </v-card-text>
                <v-layout wrap row>
                   <v-flex xs3 class="text-sm-center">
                       <v-btn text color="#F5DEB3">
                           <span>Vent</span>
                           <v-icon>mdi-finance</v-icon>
                       </v-btn><br>
                       <p class="infos-text">{{vent}} Km/h</p>
                   </v-flex>
                   <v-flex xs3 class="text-sm-center">
                       <v-btn text color="#F5DEB3">
                           <span>Humidité</span>
                           <v-icon>mdi-google-podcast</v-icon>
                       </v-btn><br>
                       <p class="infos-text">{{humidity}} %</p>
                   </v-flex>
                   <v-flex xs3 class="text-sm-center">
                       <v-btn text color="#F5DEB3">
                           <span>Min</span>
                           <v-icon>mdi-thermometer-minus</v-icon>
                       </v-btn>
                       <br>
                       <p class="infos-text">{{min}} &deg;C</p>
                   </v-flex>
                   <v-flex xs3 class="text-sm-center">
                       <v-btn text color="#F5DEB3 ">
                           <span>Max</span>
                           <v-icon>mdi-thermometer-plus</v-icon>
                       </v-btn><br>
                       <p class="infos-text">{{max}} &deg;C</p>
                   </v-flex>
                </v-layout>

                <v-divider></v-divider>
                <template>
                    <div class="text-center">
                        <v-bottom-sheet v-model="sheet">
                            <template v-slot:activator="{ on }">
                                <v-btn
                                        color="#F5DEB3"
                                        v-on="on"
                                >
                                    Voir la Carte
                                </v-btn>
                            </template>
                            <v-sheet class="text-center" height="500px">
                                <maps :gps="coord"/>
                            </v-sheet>
                        </v-bottom-sheet>
                    </div>
                </template>
                <template>

                </template>
                <v-divider></v-divider>

                <v-card-actions>
                    <v-btn outlined dark @click="effacer">Effacer</v-btn>
                </v-card-actions>
            </v-card>
    </div>
</template>
<script>
    import store from '../stores/store'
    import maps from './maps.vue'

    export default {
        store,
        components:{
            maps
        },
        props:{
            ville:String,
            temperature:Number,
            description:String,
            icon:{
                type:String,
                default: 't01n'
            },
            coord:Array,
            vent:Number,
            humidity:Number,
            min:Number,
            max:Number
        },
        data () {
            return {
                date:new Date().toISOString(),
                animation:"animated fadeInDown",
                anime:'',
                sheet: false
            }
        },
        methods:{
            effacer(){
                store.commit('setShow',false)
                this.anime = "animated fadeInUp"
            }
        }
    }
</script>
<style scoped>

</style>