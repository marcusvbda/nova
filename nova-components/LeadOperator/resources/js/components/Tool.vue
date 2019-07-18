<template>
    <div>
        <heading class="mb-6">Operador de Leads</heading>
        <div class="flex">
            <status-field
                dataroute="lead-operator/getStatus"
                :value="status_id"
                v-model="status_id"
            >
            </status-field>

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
                <lead-table :response="response" ref="table"></lead-table>
            </template>
        </div>
        
    </div>
</template>

<script>
export default {
    data() {
        return {
            status_id : this.$route.query["status_id"] ? this.$route.query["status_id"] : "all",
            search: this.$route.query["filter"] ? this.$route.query["filter"] : "",
            sortColumn : this.$route.query["_order"] ? this.$route.query["_order"] : null,
            sortDirection : this.$route.query["_direction"] ? this.$route.query["_direction"] : "desc",
            loading: true,
            response : null,
            timeout : null
        }
    },
    watch : {
        status_id(val) {
            this.filter()
        }
    },
    components : {
        "status-field": require("./-StatusField.vue"),
        "lead-table": require("./-LeadTable.vue"),
    },
    mounted() {
        this.load()
    },
    methods : {
        filter() {
            if(this.timeout) clearTimeout(this.timeout)
            this.timeout = setTimeout( () => {
                let filters = []
                filters.push({"filter": this.search ? this.search : "" })
                filters.push({"status_id": this.status_id ? this.status_id : "all" })
                let url = this.addparam(filters)
                let p = new Promise((resolve, reject) => resolve("Success!"))
                p.then(() => this.$router.replace({path: url })).then( () => {
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
                let details = $(".showing_detail")
                if(details) {
                    $(details).each(function() {
                        $(this).removeClass('showing_detail')
                        $(this).next().remove()
                    })
                }
                this.response = res
                this.loading = false
            })
        },
        addparam(rows) {
            let params = this.getparams()
            for(let row in rows)
            {
                for(let key in rows[row])
                {
                    params[key] = rows[row][key]
                }
            }
            let query = ""
            for(let param in params)
                query += ( query.indexOf("?") < 0 ) ? `?${param}=${params[param]}` : `&${param}=${params[param]}`
            let uri = window.location.href
            var a = document.createElement( 'a' )
            a.href = uri
            let url = a.href.split("/")
            url = "/"+url[url.length-1]
            if(url.indexOf("?")>0)
                url = url.substring(0,url.indexOf("?"))
            return url+query
        }
    }
}
</script>

<style>
/* Scoped Styles */
</style>
