Nova.booting((Vue, router, store) => {
    Vue.component('index-InputMask', require('./components/IndexField'))
    Vue.component('detail-InputMask', require('./components/DetailField'))
    Vue.component('form-InputMask', require('./components/FormField'))
})
