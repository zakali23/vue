import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)
export default new Vuex.Store({
    state: {
        show: false
    },
    mutations:{
        setShow(state,value){
            state.show = value
        }
    },
    actions:{},
    getters:{
       getShow(state){
          return state.show
       }
    }
})