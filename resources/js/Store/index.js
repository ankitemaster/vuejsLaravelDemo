import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';

Vue.use(Vuex)

axios.defaults.baseURL = 'http://localhost:8000/api';

export default new Vuex.Store({
  state: {
    user: {},
    isLoggedIn: false
  },
  mutations: {
    setUserData (state, userData) {
        state.isLoggedIn = true;
        state.user = userData;
    },
    clearUserData () {

    }
  },
  actions: {
    setUserData ({ commit }, userData) {
        localStorage.setItem('user', JSON.stringify(userData));
        commit('setUserData', userData);
    },
    logout ({ commit }) {
        localStorage.removeItem('user');
    }
  },
  getters : {
    isLogged: state => !!state.user
  }
})
