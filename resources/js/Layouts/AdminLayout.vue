<script setup>
    import AdminNav from '@/Components/Shared/Navs/AdminNav.vue';
</script>
<template>
    <AdminNav />
    <div class="bg-gray-100 my-height pt-4">
        <slot />
    </div>
</template>