import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
Vue.use(Vuex)
const store = new Vuex.Store({
  state: {
     play: 'play',
     title:'',
     description: ''
  },
  actions: {
    SET_SEO({ commit }, status){

      commit('SET_SEO_MUTATION', status)
    }

  },
  mutations: {
     SET_SEO_MUTATION (state, status){
        state.title = status.title;
        state.description = status.description;
     }

  },
  getters: {
    title: state => state.title
  }
})
export default store