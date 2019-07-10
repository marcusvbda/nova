<template>
<div class="bg-20 rounded-b">
    <nav class="flex items-center">
        <div class="flex text-sm">
            <button @click="go2page(1)" class="font-mono btn btn-link h-9 min-w-9 px-2 border-r border-50 text-primary dim">«</button> 
            <button class="font-mono btn btn-link h-9 min-w-9 px-2 border-r border-50 text-primary dim">‹</button> 
            <template v-for="page in pages">
                <button @click="go2page(page.value)" class= "btn btn-link h-9 min-w-9 px-2 border-r border-50" v-bind:class="{'text-80 opacity-50':page.current,'text-primary dim':!page.current}">{{page.value}}</button> 
            </template>
            <button class="font-mono btn btn-link h-9 min-w-9 px-2 border-r border-50 text-primary dim">›</button> 
            <button @click="go2page(response.last_page)" rel="last" dusk="last" class="font-mono btn btn-link h-9 min-w-9 px-2 border-r border-50 text-primary dim">»</button>
        </div>
        <span class="text-sm text-80 px-4 ml-auto">
            {{response.from}}-{{response.to}} de {{response.total}}
        </span>
    </nav>
</div>
</template>

<script>
export default {
    props: ["response"],
    data() {
        return {
            pages : []
        }
    },
    mounted() {
        this.makePages()
    },
    methods : {
        makePages(){
            this.pages = []
            let totalPages = this.response.total
            let currentPage = this.response.current_page
            let start = (currentPage-5 < 0) ? 1 : currentPage-5
            for(let i=start;i<start+5;i++)
            {   
                this.pages.push({value:i,current : currentPage==i})
            }
        },
        go2page(page)
        {
            let url = window.location.href
            console.log(url,page)
        }
    }
}
</script>