import Vue from 'vue'
//recursive require here
const files = require.context('./', true, /(\/)(?!.*\/)(?!-.*$).*\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0],files(key).default))

