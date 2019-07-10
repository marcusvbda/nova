<template>
<card>
    <div class="py-3 flex items-center border-b border-50"> </div>
    <div class="overflow-hidden overflow-x-auto relative">
        <table v-if="rows.length > 0" class="table w-full" cellpadding="0" cellspacing="0" data-testid="resource-table">
            <thead>
                <tr>
                    <th class="text-left" style="margin-left:20px;"></th>
                    <th class="text-left">
                        <sortable-td>ID</sortable-td>
                    </th>
                    <th class="text-left">
                        <sortable-td>Name</sortable-td>
                    </th>
                    <th class="text-left">
                        <sortable-td>Email</sortable-td>
                    </th>
                    <th class="text-left">
                        <sortable-td>Última Conversão</sortable-td>
                    </th>
                    <th class="text-left">
                        <sortable-td>Status</sortable-td>
                    </th>
                    <th class="text-left" style="margin-right:20px;">
                        <sortable-td>Definição</sortable-td>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="hover:bg-blue-lightest" v-for="(row,index) in rows">
                    <td>
                        <div class="status-ball" v-bind:style="{backgroundColor: `${row.status.color}`}"></div>
                    </td>
                    <td>{{row.id}}</td>
                    <td>{{row.name}}</td>
                    <td>{{row.email}}</td>
                    <td>{{row.updated_at_for_human}}</td>
                    <td>{{row.status.name}}</td>
                    <td style="margin-right:20px;">{{row.status.definition.name}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <pagination-row :response="response"></pagination-row>
</card>
</template>

<script>
export default {
    props :["response"],
    data() {
        return {
            rows : this.response.data
        }
    },
    components : {
        "sortable-td": require("./-SortableTd.vue"),
        "pagination-row": require("./-PaginationRow.vue"),
    }
}
</script>
<style lang="scss" scope>
.status-ball {
    margin-left:20px;
    min-height : 20px;
    height : 20px;
    width : 20px;
    border-radius : 100%;
}
</style>