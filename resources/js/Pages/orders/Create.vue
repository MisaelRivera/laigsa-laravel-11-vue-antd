<script setup>
    import { ref } from 'vue';
    import { useForm } from '@inertiajs/vue3';
    import AdminLayout from '@/Layouts/AdminLayout.vue';
    import { Row, Col, Input, Select, SelectOption, Form, FormItem, AutoComplete } from 'ant-design-vue';
    import { ArrowLeftOutlined } from '@ant-design/icons-vue';
    const props = defineProps({
        last_order: {
            required: true,
            type: Object,
        }
    });

    const formState = useForm({
        folio: null,
        numero_cotizacion: null,
        numero_muestras: null,
        aguas_alimentos: null,
        cliente: null,
        fecha_recepcion: null,
        hora_recepcion: null,
    });
    
    const clientOptions = ref([]);

    const handleSubmit = () => {
        console.log(formState);
    };

    const handleClientSearch = async(searchText) => 
    {
        const res = await axios.get(`/orders/get-client-for-order?search=${searchText}`);
        console.log(res.data);
        clientOptions.value = res.data.map((client) => {
           return client.cliente
        });
    };


</script>
<template>
    <AdminLayout>
        <div class="w-7/12 mx-auto my-2">
            <h1 class="text-center text-green-700 text-2xl"> 
                <a href="/orders">
                    <ArrowLeftOutlined />
                </a>
                Crear Orden
            </h1>
            <div class="bg-white py-4 px-6 rounded-md">
                <p>Ultimo folio: MFQ-{{ last_order.folio }} | {{ last_order.fecha_recepcion }} | {{ last_order.hora_recepcion }}</p>
                <p>
                    Cliente: 
                    <div 
                        class="inline-block h-5 w-5 rounded-full"
                        :class="{'bg-blue-500': last_order.aguas_alimentos === 'Aguas', 'bg-yellow-500': last_order.aguas_alimentos === 'Alimentos'}"></div>
                </p>
                <Form
                    :model="formState"
                    @finish="handleSubmit"
                    layout="vertical">
                    <Row>
                        <Col :span="5">
                            <FormItem
                                label="Folio"
                                name="folio"
                                :rules="[{required: true, message: 'Introduce el folio'}]">
                                <Input 
                                    v-model:value="formState.folio"
                                    placeholder="Folio"/>
                            </FormItem>
                        </Col>
                        <Col 
                            :span="5"
                            :offset="1">
                            <FormItem
                                label="Numero de cotizacion"
                                name="numero_cotizacion">
                                <Input 
                                    v-model:value="formState.numero_cotizacion"
                                    placeholder="Numero cotizacion"/>
                            </FormItem>
                        </Col>
                        <Col 
                            :span="5"
                            :offset="1">
                            <FormItem
                                label="Numero de muestras"
                                name="numero_muestras"
                                :rules="[{required: true, message: 'Introduce el numero de muestras'}]">
                                <Input 
                                    v-model:value="formState.numero_muestras"
                                    placeholder="Numero de muestras"/>
                            </FormItem>
                        </Col>
                        <Col 
                            :span="5"
                            :offset="1">
                            <FormItem
                                label="Aguas o alimentos"
                                name="aguas_alimentos"
                                :rules="[{required: true, message: 'Elije una de las opciones'}]">
                                <Select 
                                    v-model:value="formState.aguas_alimentos">
                                    <SelectOption :value="null">
                                        Elije una opcion
                                    </SelectOption>
                                    <SelectOption value="Aguas">
                                        Aguas
                                    </SelectOption>
                                    <SelectOption value="Alimentos">
                                        Alimentos
                                    </SelectOption>
                                </Select>
                            </FormItem>
                        </Col>
                    </Row>
                    <Row>
                        <Col :span="12">
                            <FormItem
                                label="Cliente"
                                name="cliente"
                                :rules="[{ required: true, message: 'Seleccione un cliente'}]">
                                <AutoComplete 
                                    v-model:value="formState.cliente"
                                    @search="handleClientSearch"
                                    :options="clientOptions"/>
                            </FormItem>
                        </Col>
                    </Row>
                    <button class="bg-green-600 text-white py-2 px-4 rounded">
                        Crear 
                    </button>
                </Form>
            </div>
        </div>
    </AdminLayout>
</template>