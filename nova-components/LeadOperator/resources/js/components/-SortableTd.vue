<template>
    <span class="cursor-pointer inline-flex items-center" @click="sort" ref="icon">
        <slot />
        <svg v-if="col"
            class="ml-2"
            xmlns="http://www.w3.org/2000/svg"
            width="8"
            height="14"
            viewBox="0 0 8 14"
        >
            <g id="sortable-icon" fill="none" fill-rule="evenodd">
                <path
                    :class="descClass"
                    id="Path-2-Copy-3"
                    d="M1.70710678 4.70710678c-.39052429.39052429-1.02368927.39052429-1.41421356 0-.3905243-.39052429-.3905243-1.02368927 0-1.41421356l3-3c.39052429-.3905243 1.02368927-.3905243 1.41421356 0l3 3c.39052429.39052429.39052429 1.02368927 0 1.41421356-.39052429.39052429-1.02368927.39052429-1.41421356 0L4 2.41421356 1.70710678 4.70710678z"
                />
                <path
                    :class="ascClass"
                    id="Combined-Shape-Copy-3"
                    fill-rule="nonzero"
                    d="M6.29289322 9.29289322c.39052429-.39052429 1.02368927-.39052429 1.41421356 0 .39052429.39052429.39052429 1.02368928 0 1.41421358l-3 3c-.39052429.3905243-1.02368927.3905243-1.41421356 0l-3-3c-.3905243-.3905243-.3905243-1.02368929 0-1.41421358.3905243-.39052429 1.02368927-.39052429 1.41421356 0L4 11.5857864l2.29289322-2.29289318z"
                />
            </g>
        </svg>
    </span>
</template>

<script>
export default {
    props :["col"],
    data() {
        return {}
    },
    computed: {
        ascClass() {
            if (this.isSorted && this.$parent.$parent.$parent.sortDirection == 'desc') {
                return 'fill-80'
            }
            return 'fill-60'
        },
        descClass() {
            if (this.isSorted && this.$parent.$parent.$parent.sortDirection == 'asc') {
                return 'fill-80'
            }
            return 'fill-60'
        },
        isSorted() {
            return this.$parent.$parent.$parent.sortColumn == this.col
        },
    },
    methods : {
        sort() {
            this.$parent.$parent.$parent.sortDirection = this.$parent.$parent.$parent.sortDirection=="asc" ? "desc" : "asc"
            let url = this.$parent.$parent.$parent.addparam([{"_order":this.col,"_direction":this.$parent.$parent.$parent.sortDirection}])
            let p = new Promise((resolve, reject) => resolve("Success!"))
            p.then(() => this.$router.replace({path: url })).then( () => {
                setTimeout( () => this.$parent.$parent.$parent.load(),100)
            })
            this.$parent.$parent.$parent.sortColumn = this.col
        }
    }
}
</script>

<style>
/* Scoped Styles */
</style>