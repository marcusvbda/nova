<template>
    <div class="relative h-9 flex items-center mb-6 mr-2" :class="{'overflow-hidden' : loading}">
        <div v-if="loading" class="flex items-center justify-center z-50 p-6" style="min-height: 150px">
            <loader class="text-60"/>
        </div>
        <select v-else class="form-control form-input w-search" v-model="status_id">
            <option value="all" selected>Todos Status</option>
            <option v-for="op in options" :value="op.id">{{op.name}}</option>
        </select>
    </div>
</template>

<script>
export default {
    props :["dataroute","value"],
    data() {
        return {
            options : [],
            loading : true,
            status_id : this.value
        }
    },
    watch : {
        status_id(val) {
            this.$emit("input",val)
        }
    },
    mounted() {
        this.load()
    },
    methods : {
        load() {
            Nova.request({
                url: this.dataroute,
                method: 'post',
                params : null
            }).then((res) => {
                res = res.data
                this.options = res
                this.loading = false
            })
        },
    }
}
</script>

<style>
/* Scoped Styles */
</style>
