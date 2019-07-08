import Vue from 'vue'
import axios from 'axios'
axios.defaults.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content')
Vue.prototype.$http = axios

Nova.booting((Vue, router, store) => {
    router.addRoutes([
        {
            name: 'lead-operator',
            path: '/lead-operator',
            component: require('./components/Tool'),
        },
    ])
})
