<template>
    <default-field :field="field" :errors="errors">
        <template slot="field">
            <select
                v-if="field.type=='select'"
                :id="field.name"
                class="w-full form-control form-input form-input-bordered"
                :class="errorClasses"
                :placeholder="field.name"
                v-model="value"
            >
                <option v-for="option in field.options" :value="option">{{option}}</option>
            </select>
            <input
                v-if="field.type=='text'"
                id="text"
                :type="field.type"
                class="w-full form-control form-input form-input-bordered"
                :class="errorClasses"
                :placeholder="field.name"
                v-model="value"
            />
            <input
                v-if="field.type=='number'"
                id="number"
                :type="field.type"
                class="w-full form-control form-input form-input-bordered"
                :class="errorClasses"
                :placeholder="field.name"
                v-model="value"
            />
            <input
                v-if="field.type=='email'"
                id="email"
                :type="field.type"
                class="w-full form-control form-input form-input-bordered"
                :class="errorClasses"
                :placeholder="field.name"
                v-model="value"
            />
        </template>
    </default-field>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova'

export default {
    mixins: [FormField, HandlesValidationErrors],

    props: ['resourceName', 'resourceId', 'field'],
    methods: {
        /*
         * Set the initial, internal value for the field.
         */
        setInitialValue() {
            let field = this.field
            if(!this.field.values)
            {
                field.value = ''
                return field
            }
            let value = this.field.values[this.field.field_id]
        
            this.value = value || ''
        },

        /**
         * Fill the given FormData object with the field's internal value.
         */
        fill(formData) {
            formData.append(this.field.attribute, this.value || '')
        },

        /**
         * Update the field's internal value.
         */
        handleChange(value) {
            this.value = value
        },
    },
}
</script>
