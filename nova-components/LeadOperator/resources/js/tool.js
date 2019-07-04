Nova.booting((Vue, router, store) => {
    router.addRoutes([
        {
            name: 'lead-operator',
            path: '/lead-operator',
            component: require('./components/Tool'),
        },
    ])
})
