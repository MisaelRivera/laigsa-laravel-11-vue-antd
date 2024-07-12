<script setup>
    import { ref } from 'vue';
    import CustomInput from '@/Components/Shared/CustomInput.vue';
    const emit = defineEmits(['filter']);
    const props = defineProps({
        typeProp: {
            type: String,
        },

        valueProp: {
            type: String,
            default: ''
        },

        text: {
            type: String,
        }
    });
    const value = ref(props.valueProp);
    const type = ref(props.typeProp);
    const filter = () => {
        emit('filter', type.value, value.value );
    }
</script>
<template>
    <div class="w-8/12 mx-auto my-4 bg-blue-200 rounded px-4 py-3">
        <div class="w-3/12">
            <CustomInput 
                v-model="value"
                :text="text"
                @custom="filter"/>
        </div>
    </div>
</template>