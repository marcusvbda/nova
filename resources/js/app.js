require('./bootstrap')
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
require('./components/init')
require('./libs/element')
require('./libs/axios')
import Vue from 'vue';
Vue.config.productionTip = false
let app = $("#app")
if(app.length>0) {
    var vue = new Vue({
        el: '#app',
        data() {
            return { }
        },
    })
    window.app = vue
}
