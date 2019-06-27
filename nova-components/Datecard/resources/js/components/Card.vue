<template>
    <card class="flex flex-col items-center justify-center">
        <div class="px-3 py-3">
            <h1 class="text-center text-3xl text-80 font-light">{{date}}</h1>
        </div>
    </card>
</template>

<script>
export default {
    props: [
        'card',
    ],
    computed : {
        date() {
            let data = new Date()
            let dia  = data.getDate().toString()
            let diaF = (dia.length == 1) ? '0'+dia : dia
            let mes  = (data.getMonth()+1).toString()
            let mesF = (mes.length == 1) ? '0'+mes : mes
            let anoF = data.getFullYear()
            return `${diaF}/${mesF}/${anoF}`
        }
    },
}
</script>
