<template>
<div v-loading="loading" >
    <label class="block font-bold mb-2" :for="name">{{label}}</label>
    <input style="display:none;" :name="name" :id="id" v-model="model" :required="required!=undefined ? true : false" >
    <el-select class="w-100 mb-6" filterable v-model="model" :placeholder="placeholder" :required="required!=undefined ? true : false" >
        <el-option
            v-for="item in options"
            :key="item.id"
            :label="item.name"
            :value="item.id">
        </el-option>
    </el-select>
    <button class="w-full btn btn-default btn-primary hover:bg-primary-dark" :disabled="!model" type="submit">
        {{btntext}}
    </button>
</div>
</template>

<script>
    export default {
        props: ["placeholder","value","required","route","btntext","name","id","label"],
        data() {
            return {
                loading : true,
                options : [],
                model :  this.value ? this.value : null
            }
        },
        mounted() {
            console.log()
            this.load()
        },
        methods : {
            load() {
                this.$http.get(this.route,null).then( res => {
                    res = res.data
                    this.options = res
                    this.loading = false
                }).catch(e => {
                    console.log(e)
                    this.loading = false
                })
            }
        }
    }
</script>
