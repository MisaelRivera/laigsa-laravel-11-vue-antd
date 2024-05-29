<script setup>
    import { ref } from 'vue';
    import { useForm } from '@inertiajs/vue3';
    import { FormItem, Input, Form, InputPassword } from 'ant-design-vue';
    import GuestLayout from '@/Layouts/GuestLayout.vue';
    const props = defineProps({
        title: String,
    });
    
    const formState = useForm({
        email: null,
        password: null,
    });
    
    const handleFinish = () => {

    };

    const rules = {
        email: [
            {
                required: true,
                message: 'El nombre de usuario es requerido',
                trigger: 'blur'
            },
            {
                min: 3,
                message: 'El nombre de usuario debe contar con al menos 3 caracteres'
            }
        ],

        password: [
            {
                required: true,
                message: 'El password es requerido',
                trigger: 'blur'
            },
            {
                min: 3,
                message: 'El password debe contar con al menos 3 caracteres'
            }
        ]
    };
</script>
<template>
    <GuestLayout>
        <div class="w-10/12 md:w-6/12  2xl:w-3/12 my-20 mx-auto">
            <Form
                name="login"
                class="bg-white py-4 px-6"
                :model="formState"
                :rules="rules"
                @finish="handleFinish">
                <h2 class="text-center font-semibold text-slate-800">{{ title }}</h2>
                <FormItem
                    name="email"
                    label="Usuario">
                    <Input v-model:value="formState.email"/>
                </FormItem>
                <FormItem
                    name="password"
                    label="Password">
                    <Input v-model:value="formState.password"/>
                </FormItem>
            </Form>
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