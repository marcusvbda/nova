Nova.booting((Vue, router, store) => {
    Vue.component('index-CustomFields', require('./components/IndexField'))
    Vue.component('detail-CustomFields', require('./components/DetailField'))
    Vue.component('form-CustomFields', require('./components/FormField'))
})
