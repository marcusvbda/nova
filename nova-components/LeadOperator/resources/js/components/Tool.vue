<template>
    <div>
        <heading class="mb-6">Operador de Leads</heading>
        <div class="flex justify-between">
            <div class="relative h-9 flex items-center mb-6">
                <icon type="search" class="absolute ml-3 text-70"/>

                <input
                    class="appearance-none form-control form-input w-search pl-search"
                    placeholder="Pesquisar..."
                    type="search"
                    v-model="search"
                    @input.stop="filter"
                >
            </div>
        </div>
        <div class="relative" :class="{'overflow-hidden' : loading}">
            <div v-if="loading" class="flex items-center justify-center z-50 p-6" style="min-height: 150px">
                <loader class="text-60"/>
            </div>
            <template v-else>
                <lead-table :response="response"></lead-table>
            </template>
        </div>
        
    </div>
</template>

<script>
export default {
    data() {
        return {
            search: null,
            loading: true,
            response : null,
            timeout : null
        }
    },
    components : {
        "lead-table": require("./-LeadTable.vue"),
    },
    mounted() {
        this.load()
    },
    methods : {
        filter() {
            if(this.timeout) clearTimeout(this.timeout)
            this.timeout = setTimeout( () => {
                let url = this.addparam("filter",this.search)
                let p = new Promise((resolve, reject) => resolve("Success!"))
                p.then(() => this.$root.$router.replace({path: url })).then( () => {
                    setTimeout( () => this.load(),100)
                })
            },500)
        },
        getparams() {
            let p = new URLSearchParams(location.search.slice(1))
            return p
                ? _.fromPairs(Array.from(p.entries()))
                : {}
        },
        load() {
            Nova.request({
                url: "lead-operator/search",
                method: 'post',
                params : this.getparams()
            }).then((res) => {
                res = res.data
                this.response = res
                this.loading = false
            })
        },
        addparam(key,value) {
            let uri = window.location.href
            var a = document.createElement( 'a' ), 
                reg_ex = new RegExp( key + '((?:\\[[^\\]]*\\])?)(=|$)(.*)' ),
                qs,
                qs_len,
                key_found = false
            a.href = uri
            if ( ! a.search ) {
                a.search = '?' + key + '=' + value
                let url = a.href.split("/")
                url = "/"+url[url.length-1]
                return url
            }
            qs = a.search.replace( /^\?/, '' ).split( /&(?:amp;)?/ )
            qs_len = qs.length
            while ( qs_len > 0 ) {
                qs_len--;
                if ( ! qs[qs_len] ) { qs.splice(qs_len, 1); continue }
                if ( reg_ex.test( qs[qs_len] ) ) {
                    qs[qs_len] = qs[qs_len].replace( reg_ex, key + '$1' ) + '=' + value
                    key_found = true
                }
            }   
            if ( ! key_found ) { qs.push( key + '=' + value ) }
            a.search = '?' + qs.join( '&' )
            let url = a.href.split("/")
            url = "/"+url[url.length-1]
            return url
        }
    }
}
</script>

<style>
/* Scoped Styles */
</style>
