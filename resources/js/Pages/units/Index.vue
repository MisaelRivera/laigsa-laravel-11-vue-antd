<script setup>
    import { ref } from 'vue';
    import AdminLayout from '@/Layouts/AdminLayout.vue';
    import IndexTitle from '@/Components/Shared/IndexTitle.vue';
    import { usePage, Link, useForm } from '@inertiajs/vue3';
    import { Alert, Modal } from 'ant-design-vue';
    const props = defineProps({
        units: Object
    });
    const page = usePage();
    const deleteModalOpen = ref(false);
    const deleteUnit = useForm({
        id: null,
        name: null,
    });
    const handleOpenModal = (id, name) => {
        deleteUnit.id = id;
        console.log(id);
        console.log(name);
        deleteUnit.name = name;
        deleteModalOpen.value = true;
    }; 
    const handleDelete = () => {
        deleteUnit.delete('/units/' + deleteUnit.id);
        deleteModalOpen.value = false;
    };
</script>
<template>
    <AdminLayout>
        <div class="w-10/12 mx-auto">
            <Alert
                type="success"
                v-if="page.props.flash.message"
                :message="page.props.flash.message"
                closable
                class="mb-3"/>
            <div>
                <IndexTitle 
                    title="Unidades"
                    add-link="/units/create"
                    own-link="/units"/>
            </div>
            <table class="border">
                <thead>
                    <tr>
                        <th class="border">Unidad</th>
                        <th class="border"></th>
                        <th class="border"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="unit in units">
                        <td class="py-2 px-2 border">{{ unit.nombre }}</td>
                        <td class="py-2 px-2 border">
                            <Link 
                                class="w-10 h-10 rounded-full py-2 px-2 bg-blue-500 text-white text-xs"
                                :href="`/units/edit/${unit.id}`">
                                Edit
                            </Link>
                        </td>
                        <td class="py-2 px-2 border">
                            <button 
                                class="rounded-full h-10 w-10 text-white text-center bg-red-400 text-xs"
                                @click="() => handleOpenModal(unit.id, unit.nombre)">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <Modal 
            v-model:open="deleteModalOpen"
            title="Eliminar unidad"
            @ok="() => handleDelete(deleteUnit.id)">
                <p>Seguro que deseas borrar la unidad {{ deleteUnit.name }}?</p>
        </Modal>
    </AdminLayout>
</template>
