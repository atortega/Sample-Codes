import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        status: '',
        token: localStorage.getItem('token') || '',
        user : JSON.parse(localStorage.getItem('user')) || {}
    },
    mutations: {
        auth_request(state){
            state.status = 'loading'
        },
        auth_success(state, token, user){
            //console.log('Auth Sucess', localStorage.getItem('token'), localStorage.getItem('user'))
            state.status = 'success'
            state.token = token
            state.user = JSON.parse(localStorage.getItem('user'))
            console.log('aner', token, state.user, user)
        },
        auth_error(state){
            state.status = 'error'
        },
        logout(state){
            state.status = ''
            state.token = ''
            state.user = {}
        },
    },
    actions: {
        login({commit}, userdata){
            return new Promise((resolve, reject) => {
                commit('auth_request')
                axios({url: '/api/login', data: userdata, method: 'POST' })
                .then(resp => {
                    console.log(resp)
                    const token = resp.data.access_token
                    const user = resp.data.user
                    localStorage.setItem('token', token)
                    localStorage.setItem('user', JSON.stringify(user))
                    console.log(JSON.stringify(user))
                    axios.defaults.headers.common['Authorization'] = token
                    commit('auth_success', token, user)
                    console.log(token, user)
                    console.log('Login successful')
                    resolve(resp)
                })
                .catch(err => {
                    commit('auth_error')
                    localStorage.removeItem('token')
                    localStorage.removeItem('user')
                    reject(err)
                })
            })
        },
        register({commit}, userdata) {
            return new Promise((resolve, reject) => {
                commit('auth_request')
                axios({url: '/api/register', data: userdata, method: 'POST' })
                .then(resp => {
                    const token = resp.data.access_token
                    const user = resp.data.user
                    localStorage.setItem('token', token)
                    localStorage.setItem('user', JSON.stringify(user))
                    axios.defaults.headers.common['Authorization'] = token
                    commit('auth_success', token, user)
                    console.log(token, user)
                    console.log('Login successful')
                    resolve(resp)
                })
                .catch(err => {
                    commit('auth_error')
                    localStorage.removeItem('token')
                    localStorage.removeItem('user')
                    reject(err)
                })
            })
        },
        logout({commit}){
            return new Promise((resolve, reject) => {
                console.log('Logout')
                commit('logout')
                localStorage.removeItem('token')
                localStorage.removeItem('user')
                delete axios.defaults.headers.common['Authorization']
                resolve()
            })
        }
    },
    getters : {
        isLoggedIn: state => {
            return !!state.token
        },
        isGuest: state => {
            return state.token
        },
        authStatus: state => {
            return state.status
        },
        user: state => {
            return state.user
        }
    }
})


