import Vue from 'vue'
Vue.prototype.$addparam = (url, param, value) => {
    param = encodeURIComponent(param);
    var r = "([&?]|&amp;)" + param + "\\b(?:=(?:[^&#]*))*";
    var a = document.createElement('a');
    var regex = new RegExp(r);
    var str = param + (value ? "=" + encodeURIComponent(value) : ""); 
    a.href = url;
    var q = a.search.replace(regex, "$1"+str);
    if (q === a.search) {
        a.search += (a.search ? "&" : "") + str;
    } else {
        a.search = q;
    }
    return a.href;
}
Nova.booting((Vue, router, store) => {
    router.addRoutes([
        {
            name: 'lead-operator',
            path: '/lead-operator',
            component: require('./components/Tool'),
        },
    ])
})
