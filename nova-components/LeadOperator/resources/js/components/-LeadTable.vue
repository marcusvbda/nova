<template>
<card>
    <div class="py-3 flex items-center border-b border-50"> </div>
    <div class="overflow-hidden overflow-x-auto relative">
        <table v-if="data.length > 0" class="table w-full" cellpadding="0" cellspacing="0" data-testid="resource-table">
            <thead>
                <tr>
                    <th class="text-left" style="width: 100px">
                        <sortable-td>ID</sortable-td>
                    </th>
                    <th class="text-left" style="width: 100px">
                        <sortable-td>Name</sortable-td>
                    </th>
                    <th class="text-left" style="width: 140px">
                        <sortable-td>Email</sortable-td>
                    </th>
                    <th class="text-left">
                        <sortable-td>Conversões</sortable-td>
                    </th>
                    <th class="text-left">
                        <sortable-td>Última Conversão</sortable-td>
                    </th>
                    <th class="text-left">
                        <sortable-td>Status</sortable-td>
                    </th>
                    <th class="text-left">
                        <sortable-td>Definição</sortable-td>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="hover:bg-blue-lightest" v-for="(row,index) in data">
                    <td>1234</td>
                    <td>1234</td>
                    <td>1234</td>
                    <td>1234</td>
                    <td>1234</td>
                    <td>1234</td>
                    <td>1234</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="bg-20 rounded-b">
        <nav class="flex items-center">
            <div class="flex text-sm"><button disabled="disabled" rel="first" dusk="first" class="font-mono btn btn-link h-9 min-w-9 px-2 border-r border-50 text-80 opacity-50">
                «
                </button> <button disabled="disabled" rel="prev" dusk="previous" class="font-mono btn btn-link h-9 min-w-9 px-2 border-r border-50 text-80 opacity-50">
                ‹
                </button> <button dusk="page:1" class="btn btn-link h-9 min-w-9 px-2 border-r border-50 text-80 opacity-50">
                1
                </button> <button disabled="disabled" rel="next" dusk="next" class="font-mono btn btn-link h-9 min-w-9 px-2 border-r border-50 text-80 opacity-50">
                ›
                </button> <button disabled="disabled" rel="last" dusk="last" class="font-mono btn btn-link h-9 min-w-9 px-2 border-r border-50 text-80 opacity-50">
                »
                </button>
            </div>
            <span class="text-sm text-80 px-4 ml-auto">
                1-4 de 4
            </span>
        </nav>
    </div>
</card>
</template>

<script>
export default {
    props : {
        data : {
            type : Array,
            default : []
        }
    },
    data() {
        return {
        }
    },
    components : {
        "sortable-td": require("./-SortableTd.vue")
    }
}
</script>