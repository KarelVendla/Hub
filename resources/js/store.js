export default {
    state: {
        user: {
            userId: '',
            username: '',
            password: '',
            email: '',
            message: ''
        },
        roomId: '',
        currentUser: null,
        users: null,
        initialMessages: []
    },
    mutations: {

        //USER
        SET_USERID ({user}, payload) {
            user.userId = payload.userId;
        },
        SET_USERNAME ({user}, payload) {
            user.username = payload.username;
        },
        SET_PASSWORD ({user}, payload) {
            user.password = payload.password;
        },
        SET_EMAIL ({user}, payload) {
            user.email = payload.email;
        },
        SET_MESSAGE ({user}, payload) {
            user.message = payload.message;
        }
    },
    getters: {
        //USER
        GET_USERID ({user}) {
            return user.userId;
        },
        GET_USERNAME ({user}) {
            return user.username;
        },
        GET_PASSWORD ({user}) {
            return user.password;
        },
        GET_EMAIL ({user}) {
            return user.email;
        },
        GET_MESSAGE ({user}) {
            return user.message;
        }
    },
    actions: {
        //USER
        SET_USERID({commit}, id) {

        }
    }
};