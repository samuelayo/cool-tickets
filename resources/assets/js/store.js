import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
Vue.use(Vuex)
const store = new Vuex.Store({
    state: {
        play: 'play',
        title: '',
        description: '',
        current_state: 'Lagos',
        current_stream: 'http://icestream.coolwazobiainfo.com:8000/coolfm-lagos'
    },
    actions: {
        SET_SEO({ commit }, status) {

            commit('SET_SEO_MUTATION', status)
        },
        SET_STATE({ commit }, status) {
            commit('SET_STATE_MUTATION', status)
        },
        SET_STREAM({ commit }, stream) {
            commit('SET_STREAM_MUTATION', stream)
        }

    },
    mutations: {
        SET_SEO_MUTATION(state, status) {
            state.title = status.title;
            state.description = status.description;
        },
        SET_STATE_MUTATION(state, status) {
            state.current_state = status
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toast-bottom-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "100000",
                "timeOut": "50000000",
                "extendedTimeOut": "1000000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            toastr.success('You are now listening to Coolfm ' + status);
        },
        SET_STREAM_MUTATION(state, stream) {
            state.current_stream = stream


        }

    },
    getters: {
        title: state => state.title,
        current_state: state => state.current_state,
        current_stream: state => state.current_stream
    }
})
export default store