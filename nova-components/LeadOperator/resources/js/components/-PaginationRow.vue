<template>
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
</template>

<script>
export default {
    props: [],
    data() {
        return {}
    }
}
</script>