<template>
    <span>{{ processed_field.value }}</span>
</template>

<script>
export default {
    props: ['resourceName', 'field'],
    computed: {
        processed_field() {
            let field = this.field
            let value = this.field.values.find(x => x.custom_field_id == this.field.field_id)
            if(!value)
                field.value = ""
            else
                field.value = value.value || ''
            return field
        }
    },
}
</script>
