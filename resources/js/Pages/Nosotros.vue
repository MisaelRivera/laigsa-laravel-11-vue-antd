<script setup>
    import { ref } from 'vue';
    import GuestLayout from '@/Layouts/GuestLayout.vue';
    const props = defineProps({
        title: String
    });
    const titleProp = ref(props.title);
    const handleChangeText = () => {
        titleProp.value = 'Estos somos nosotros';
    };
</script>

<template>
    <GuestLayout>
        <h1 class="font-bold ml-2 text-2xl">{{ titleProp }}</h1>
        <button @click="handleChangeText" class="px-4 py-2 border-transparent rounded-md bg-emerald-400 text-white">Traducir texto</button>
    </GuestLayout>
</template>