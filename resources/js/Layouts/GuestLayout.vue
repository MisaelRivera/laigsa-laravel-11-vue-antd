<script setup>
    import GuestNav from '@/Components/Shared/Navs/GuestNav.vue';
</script>
<template>
    <GuestNav />
    <div class="bg-gray-100 my-height pt-4">
        <slot />
    </div>
</template>