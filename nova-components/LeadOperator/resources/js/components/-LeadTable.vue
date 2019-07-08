<template>
<div>
    <div class="flex flex-wrap -mx-3 mb-3" v-if="rows">
        <div class="px-3 mb-6 w-1/3" v-for="(row,index) in rows">
            <div class="card relative px-6 py-4 card-panel lead" v-bind:style="{borderTop: `3px solid ${row.status.color}`}">
                <p><b>Nome : </b>{{row.name}}</p>
                <hr>
                <p><b>Última Atualização : </b>{{row.updated_at_for_human}}</p>
                <p><b>Email : </b><a :href="`mailto:${row.email}`">{{row.email}}</a></p>
                <p><b>Telefone : </b>{{row.phone}}</p>
                <p><b>Celular : </b>{{row.cell}}</p>
                <hr>
                <template v-for="field in row.custom_fields">
                    <p><b>{{field.name}} : </b><span v-if="row.custom_values[field.id]">{{row.custom_values[field.id]}}</span></p>
                </template>
                <hr>
                <p><b>Cidade : </b>{{row.city}} - {{row.state}}</p>
                <hr>
                <p><b>Status : </b><span class="status badge">{{row.status.name}}</span></p>
            </div>
        </div>
    </div>
    <pagination-row></pagination-row>
</div>
</template>

<script>
export default {
    props: ["data"],
    data() {
        return {
            rows : this.data
        }
    },
    mounted() {
        console.log(this.rows)
        console.log("Mostrar paginas e totalizadores")
    },
    components : {
        "sortable-td": require("./-SortableTd.vue"),
        "pagination-row": require("./-PaginationRow.vue"),
    }
}
</script>
<style scoped lang="scss">
.lead {
    &.card {
        opacity:.5;
        display: inline-table;
        width: 100%;
        height:100%;
        cursor:pointer;
        &:hover {
            opacity:1;
            transition:.7s;
            transform: scale(1.05); 
        }
    }
}
</style>