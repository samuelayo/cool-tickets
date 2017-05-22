import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
Vue.use(Vuex)
const store = new Vuex.Store({
    state: {
        play: 'play',
        current_state: 'Lagos',
        current_stream: 'http://icestream.coolwazobiainfo.com:8000/coolfm-lagos'
    },
    actions: {
        SET_PLAY({ commit }, status) {

            commit('SET_PLAY_MUTATION', status)
        },
        SET_STATE({ commit }, status) {
            commit('SET_STATE_MUTATION', status)
        },
        SET_STREAM({ commit }, stream) {
            commit('SET_STREAM_MUTATION', stream)
        }

    },
    mutations: {
        SET_PLAY_MUTATION(state, status) {
            var player = document.getElementById('coolradio');
            if (status == "pause") {
                player.play();
            } else {
                player.pause();
            }
            state.play = status;
        },
        SET_STATE_MUTATION(state, status) {
            state.current_state = status
        },
        SET_STREAM_MUTATION(state, stream) {
            state.current_stream = stream
        }

    },
    getters: {
        playstatus: state => state.play,
        current_state: state => state.current_state,
        current_stream: state => state.current_stream
    }
})
export default store