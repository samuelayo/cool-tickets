import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
Vue.use(Vuex)
const store = new Vuex.Store({
  state: {
     play: 'play'
  },
  actions: {
    SET_PLAY ({ commit }, status){

      commit('SET_PLAY_MUTATION', status)
    }

  },
  mutations: {
    SET_PLAY_MUTATION (state, status) {
      var player = document.getElementById('coolradio');
      if(status == "pause"){
        player.play();
      }else{
        player.pause();
      }
      state.play = status;
    }

  },
  getters: {
    playstatus: state => state.play
  }
})
export default store