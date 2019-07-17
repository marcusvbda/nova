import Vue from 'vue'

Nova.booting((Vue, router, store) => {
    router.addRoutes([
        {
            name: 'lead-operator',
            path: '/lead-operator',
            component: require('./components/Tool'),
        },
        // {
        //     name: 'lead-operator-detail',
        //     path: '/lead-operator/detail/:id',
        //     component: require('./components/-Detail'),
        // },
    ])
})
