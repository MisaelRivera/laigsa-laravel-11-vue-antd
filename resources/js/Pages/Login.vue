<script setup>
    import { ref } from 'vue';
    import { FormItem, Input } from 'ant-design-vue';
    import { FormKit } from '@formkit/vue';
    import GuestLayout from '@/Layouts/GuestLayout.vue';
    import { EyeInvisibleOutlined, EyeOutlined } from '@ant-design/icons-vue';
    const props = defineProps({
        title: String,
    });
    const closedEye = ref(true);
    const handleClosedEye = (ev) => {
        const icon = ev.target;
        console.log(icon)
        const parent = icon.parentElement.previousElementSibling;
        console.log(parent);
        parent.type = closedEye.value ? 'password':'text';
       closedEye.value = !closedEye.value;
    }

    const handleSubmit = (data) => {
        console.log(data);
    };
</script>
<template>
    <GuestLayout>
        <div class="w-10/12 md:w-6/12  2xl:w-3/12 my-20 mx-auto">
            <FormKit 
                type="form"
                @submit="handleSubmit"
                :config="{
                    classes:{
                        form: 'border-2 px-6 py-3 rounded-lg border-slate-500',
                        inner: 'text-base flex items-center w-full py-2 px-3 rounded border border-neutral-400 bg-white focus-withing:ring-1 focus-within:ring-blue-500 focus-within:border-blue-500',
                        input: 'grow outline-0',
                        messages: 'text-red-500',
                    }
                }"
                :submit-attrs="{
                    inputClass:'bg-blue-500 text-white py-2 px-3 rounded',
                    wrapperClass: 'mt-2'
                }"
                >
                <h2 class="text-center font-semibold text-slate-800">{{ title }}</h2>
                <FormKit 
                    type="text" 
                    name="email"
                    label="Email"
                    placeholder="Ingresa tu correo..."
                    validation="required|*length:5"/>
                <FormKit 
                    type="password" 
                    name="password"
                    label="Password"
                    placeholder="Ingresa tu contraseña..."
                    validation="required|*length:8">
                    <template #suffix>
                        <EyeInvisibleOutlined v-if="closedEye"
                            @click="handleClosedEye"/>
                        <EyeOutlined v-else
                            @click="handleClosedEye"/>
                    </template>
                </FormKit>
                <FormItem
                    label="Test"
                    name="test"
                    :rules="[{required: true, message: 'La prueba es requerida'}]">
                    <Input class="custom"/>
                </FormItem>
            </Formkit>
        </div>
    </GuestLayout>
</template>
<style>
    .custom.ant-input {
        border: none;
        border-bottom: 1px solid #212529;
    }

    .custom.ant-input:focus {
        border-bottom: 2px solid green;
    }
</style>