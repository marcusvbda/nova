<template>
    <panel-item :field="processed_field" />
</template>

<script>
export default {
    props: ['resource', 'resourceName', 'resourceId', 'field'],
    computed: {
        processed_field() {
            let field = this.field
            if(!this.field.values)
            {
                field.value = ''
                return field
            }
            let value = this.field.values[this.field.field_id]
            field.value = value || ''
            return field
        }
    },
}
</script>
