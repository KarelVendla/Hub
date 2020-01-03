import register from './components/Register.vue'

export default {


    mode: 'history',

    routes: [
        {
            path:'/register',
            component: {
                register
            }
        }
    ]
};