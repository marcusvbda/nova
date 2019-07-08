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
                    @keydown.stop="performSearch"
                >
            </div>
        </div>
        <div class="relative" :class="{'overflow-hidden' : loading}">
            <div v-if="loading" class="flex items-center justify-center z-50 p-6" style="min-height: 150px">
                <loader class="text-60"/>
            </div>
            <template v-else>
                <lead-table :data="data"></lead-table>
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
            data : []
        }
    },
    components : {
        "sortable-td": require("./-SortableTd.vue"),
        "lead-table": require("./-LeadTable.vue"),
    },
    mounted() {
        this.init()
    },
    methods : {
        init() {
            Nova.request({
                url: "lead-operator/search",
                method: 'post',
                params : {teste:1234}
            }).then((res) => {
                res = res.data
                this.data = res.data
                this.loading = false
            })
        }
    }
}
</script>

<style>
/* Scoped Styles */
</style>
