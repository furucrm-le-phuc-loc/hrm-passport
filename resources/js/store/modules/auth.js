import Vue from 'vue';
import axios from 'axios';


// const state = {
//     isAuth: "oakdoakdoakd",
//     // role: "admin",
//     user: {

//     },
// }

// const mutations = {
//     setUser (state, userObj) {
//         console.log("welcome back");
//         // state.user = Object.assign({}, state.user, userObj);
//         state.isAuth = "aaaaaaaaaa";
//         // state.user.assign(userObj);
//         // Vue.set(state, 'user', userObj);
//         // console.log(state.user);
//     },


// }

// const actions = {
//     loginUser: ({commit}, user) => {
//         // console.log("welcome back");
//         // commit('setUser', "assssssssdaaaaaaaaaaaaaaaasssssss");
//         axios.post("/api/auth/login", {
//             name: user.name,
//             password: user.password
//         })
//         .then(response => {
//             //save token
//             // console.log(response.data.user);
//             localStorage.setItem(
//                 'token',
//                 response.data.token
//             )
//             commit('setUser', response.data.user);
//             window.location.replace("/");
//         })

//     },

//     logoutUser: ({commit}) => {
//         // console.log("logout");
//         commit('setUser', null);
//         commit('setAuth', false);
//         localStorage.removeItem('token');
//         window.location.replace("/login");
//     }
// }

// export default {
//     namespaced: true,
//     state,
//     mutations,
//     actions
// }

export default {
    namespaced: true,

    state: {
        user: {}
    },

    mutations: {
        setUser (state, userObj) {
            Object.assign(state.user, userObj);
            // state.user = userObj;
        },
    },

    actions: {
        loginUser: ({commit}, user) => {
            console.log("welcome back");
            // commit('setUser', "assssssssdaaaaaaaaaaaaaaaasssssss");
            axios.post("/api/auth/login", {
                name: user.name,
                password: user.password
            })
            .then(response => {
                //save token
                // console.log(response.data.user);
                localStorage.setItem(
                    'token',
                    response.data.token
                )
                commit('setUser', response.data.user);
                window.location.replace("/");
            })

        },
        logoutUser: ({commit}) => {
            // console.log("logout");
            commit('setUser', null);
            localStorage.removeItem('token');
            window.location.replace("/login");
        },

        currentUser: ({commit}) => {

            axios.get('/api/auth/user')
            .then(response => {
                commit('setUser', response.data.user);
                console.log(response.data.user)
            });
        }


    },
    getters: {
        Auth: state => {
            return state.user;
        }
    }




}
