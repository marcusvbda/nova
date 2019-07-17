<template>
<card>
    <div class="py-3 flex items-center border-b border-50"> </div>
    <div class="overflow-hidden overflow-x-auto relative">
        <table v-if="rows.length > 0" class="table w-full" cellpadding="0" cellspacing="0" ref="table">
            <thead>
                <tr>
                    <th style="margin-left:20px;"></th>
                    <th>
                        <sortable-td col="id">ID</sortable-td>
                    </th>
                    <th>
                        <sortable-td col="name">Name</sortable-td>
                    </th>
                    <th>
                        <sortable-td col="email">Email</sortable-td>
                    </th>
                    <th>
                        <sortable-td col="updated_at">Última Conversão</sortable-td>
                    </th>
                    <th>
                        <sortable-td>Status</sortable-td>
                    </th>
                    <th  style="margin-right:20px;"></th>
                </tr>
            </thead>
            <tbody>
                <tr class="hover:bg-blue-lightest" v-for="(row,index) in rows" :data="row.id">
                    <td style="text-align:center;">
                        <span class="details-control" @click.prevent href="#" >
                            <span class="more icon_button" title="clique para ver mais detalhes">➕</span>
                            <span class="less icon_button" title="clique para ver menos detalhes">➖</span>
                        </span>
                    </td>
                    <td class="text-center">{{row.id}}</td>
                    <td class="text-center">{{row.name}}</td>
                    <td class="text-center">{{row.email}}</td>
                    <td class="text-center">{{row.updated_at_for_human}}</td>
                    <td class="text-center">
                        <span class="status-badge"  v-bind:style="{borderColor: `${row.status.color}`,color: `${row.status.color}`}">
                            {{row.status.name}}
                        </span>
                    </td>
                    <td style="margin-right:20px;" class="text-center">
                        <span class="ml-2 icon_button" href="#" title="clique para operar">⚡</span>
                    </td>
                </tr>
            </tbody>
        </table>
        <template v-else>
            <div class="relative">
                <div class="flex justify-center items-center px-6 py-8" style="">
                    <div class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="65" height="51" viewBox="0 0 65 51" class="mb-3">
                            <g id="Page-1" fill="none" fill-rule="evenodd">
                                <g id="05-blank-state" fill="#A8B9C5" fill-rule="nonzero" transform="translate(-779 -695)">
                                    <path id="Combined-Shape" d="M835 735h2c.552285 0 1 .447715 1 1s-.447715 1-1 1h-2v2c0 .552285-.447715 1-1 1s-1-.447715-1-1v-2h-2c-.552285 0-1-.447715-1-1s.447715-1 1-1h2v-2c0-.552285.447715-1 1-1s1 .447715 1 1v2zm-5.364125-8H817v8h7.049375c.350333-3.528515 2.534789-6.517471 5.5865-8zm-5.5865 10H785c-3.313708 0-6-2.686292-6-6v-30c0-3.313708 2.686292-6 6-6h44c3.313708 0 6 2.686292 6 6v25.049375c5.053323.501725 9 4.765277 9 9.950625 0 5.522847-4.477153 10-10 10-5.185348 0-9.4489-3.946677-9.950625-9zM799 725h16v-8h-16v8zm0 2v8h16v-8h-16zm34-2v-8h-16v8h16zm-52 0h16v-8h-16v8zm0 2v4c0 2.209139 1.790861 4 4 4h12v-8h-16zm18-12h16v-8h-16v8zm34 0v-8h-16v8h16zm-52 0h16v-8h-16v8zm52-10v-4c0-2.209139-1.790861-4-4-4h-44c-2.209139 0-4 1.790861-4 4v4h52zm1 39c4.418278 0 8-3.581722 8-8s-3.581722-8-8-8-8 3.581722-8 8 3.581722 8 8 8z"></path>
                                </g>
                            </g>
                        </svg>
                        <h3 class="text-base text-80 font-normal mb-6">
                            Nenhum encontrado.
                        </h3>
                    </div>
                </div>
            </div>
        </template>
    </div>
    <pagination-row :page="response.current_page" :pages="response.last_page" v-if="rows.length > 0"></pagination-row>
</card>
</template>

<script>
export default {
    props :["response"],
    data() {
        return {}
    },
    components : {
        "sortable-td": require("./-SortableTd.vue"),
        "pagination-row": require("./-PaginationRow.vue"),
    },
    computed : {
        rows() {
            return this.response.data
        }
    },
    mounted() {
        this.startListeningDetail()
    },
    methods : {
        startListeningDetail() {
            let self = this
            $(this.$refs.table).find('tbody').on('click', '.details-control', function() {
                var tr = $(this).closest('tr')
                if($(tr).hasClass("showing_detail" )) {
                    tr.removeClass('showing_detail')
                    tr.next().remove()
                } else 
                    self.getDetail(tr)
            });
        },
        getDetail(tr) {
            let data = $(tr).attr("data")
            Nova.request({
                url: `lead-operator/detail/${data}`,
                method: 'post'
            }).then((res) => {
                res = res.data
                let colspan = $(this.$refs.table).find("tr:first th").length
                tr.after(`<tr class="lead-detail"><td colspan="${colspan}">${res}</td></tr>`)
                tr.addClass('showing_detail')
            })
        }
    }
}
</script>
<style lang="scss" scope>
.status-badge {
    padding: 2px 10px 2px 10px;
    border: 2px solid black;
    border-radius: 10px;
    font-weight: 600;
    font-size:13px;
}
.text-center {
    text-align: center;
}
.icon_button {
    cursor:pointer;
    font-size:30px;
    opacity:.5;
    &:hover {
        transition:.5s;
        opacity:1;
    }
}
.less {
    font-size:15px;
    display :none;
}
.more {
    font-size:15px;
    display :block;
}
.showing_detail {
    .more {
        font-size:15px;
        display:none;
    }
    .less {
        display :block;
    }
}
.lead-detail {
    .content {
        padding: 20px 30px 20px 30px!important;
    }
}
.ml-2 {
    margin-left : 10px;
}
.status-ball {
    min-height : 20px;
    height : 20px;
    width : 20px;
    border-radius : 100%;
}
</style>