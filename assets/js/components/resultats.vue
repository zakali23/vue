<template>
    <v-card
            class="mx-auto"
            color="#F9F9F9"

    >
        <v-list-item two-line>
            <v-list-item-content>
                <v-list-item-title class="headline">{{ville}}</v-list-item-title>
                <v-list-item-subtitle>{{date| moment("dddd,Do MMMM  YYYY")}}</v-list-item-subtitle>
            </v-list-item-content>
        </v-list-item>

        <v-card-text>
            <v-row align="center">
                <v-col class="display-3" cols="6">
                    {{temperature}}&deg;C
                </v-col>
                <v-col cols="6">
                    <v-img
                            :src="`http://openweathermap.org/img/wn/${icon}@2x.png`"
                            alt="Sunny image"
                            width="90"
                    ></v-img>
                    <h1>{{description}}</h1>
                </v-col>
            </v-row>
        </v-card-text>

        <v-list-item>
            <v-list-item-icon>
                <v-icon>mdi-send</v-icon>
            </v-list-item-icon>
            <v-list-item-subtitle>{{vent}} km/h</v-list-item-subtitle>
        </v-list-item>

        <v-list-item>
            <v-list-item-icon>
                <v-icon>mdi-cloud-download</v-icon>
            </v-list-item-icon>
            <v-list-item-subtitle>{{humidity}}%</v-list-item-subtitle>
        </v-list-item>

        <v-divider></v-divider>
        <template>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d83998.75769515168!2d2.277020492155876!3d48.85895068065112!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e1f06e2b70f%3A0x40b82c3688c9460!2sParis!5e0!3m2!1sfr!2sfr!4v1570378963932!5m2!1sfr!2sfr" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
        </template>
        <v-divider></v-divider>

        <v-card-actions>
            <v-btn text>Full Report</v-btn>
        </v-card-actions>
    </v-card>
</template>
<script>
    export default {
        props:{
            ville:String,
            temperature:Number,
            description:String,
            icon:String,
            vent:Number,
            humidity:Number
        },
        data () {
            return {
                date:new Date().toISOString(),
                labels: ['SU', 'MO', 'TU', 'WED', 'TH', 'FR', 'SA'],
                time: 0,
                forecast: [
                    { day: 'Tuesday', icon: 'mdi-white-balance-sunny', temp: '24\xB0/12\xB0' },
                    { day: 'Wednesday', icon: 'mdi-white-balance-sunny', temp: '22\xB0/14\xB0' },
                    { day: 'Thursday', icon: 'mdi-cloud', temp: '25\xB0/15\xB0' },
                ],
            }
        },
    }
</script>