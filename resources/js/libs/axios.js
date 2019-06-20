import Vue from 'vue'
import axios from 'axios'
axios.defaults.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content')
Vue.prototype.$http = axios