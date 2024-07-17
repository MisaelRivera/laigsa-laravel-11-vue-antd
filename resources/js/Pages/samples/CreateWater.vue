<script setup>
    import { ref, reactive, computed, h } from 'vue';
    import { FormKit } from '@formkit/vue';
    import { Alert, Radio, Checkbox, RadioGroup, Textarea, Button, Form, Input, FormItem, Col, Row } from 'ant-design-vue';
    import { router, usePage, useForm } from '@inertiajs/vue3';
    import { createRange } from '@/helpers/time_helper.js';
    import AdminLayout from '@/Layouts/AdminLayout.vue';
    import CreateTitle from '@/Components/Shared/CreateTitle.vue';
    import CustomInput from '@/Components/Shared/CustomInput.vue';

    const props = defineProps({
        order: Object,
        numeroMuestras: Number,
        inicioMuestras: Number,
        identificacionesMuestra: Array,
        parametersProp: Array,
        errors: Object,
    });

    const page = usePage();
    const activeKey = ref('1');
    const oldParams = [
        "NOM-001-SEMARNAT-2021", "NOM-001-SEMARNAT-2021- incluir DBO5, Solidos Sedimentables, Materia Flotante, Coliformes Fecales", "Nom-001-semarnat-1996", "Nom-001-semarnat-1996/color verd, cloruros, e. coli, enterococos fecales. Contratar toxicidad vibrio fisheri,  cot", "Nom-001-semarnat-1996/sin met y cn", "NOM-127-SSA1-2021 Norma completa", "NOM-127-SSA1-2021, Parte de la Norma",  "Nom-127-ssa1-1994. Parte de la norma", "Nom-127-ssa1-1994. Parte de la norma/con olor y sabor", "Nom-127-ssa1-1994. Norma completa/con olor y sabor", "Nom-002-semarnat-1996", "Nom-003-semarnat-1996", "CT, As, Pb, Fluor", "CF, CT (purificada)", "CT (purificada)", "Salmonella. Contratar toxicidad", "Dureza, alcalinidad, ph, conductividad, metales.",  "E. Coli, cf, ct de nom-127-ssa1-1994.",  "Mesofilicos aerobios",  "Ph, cn",  "Sst, ss, dqo, ntk, nitratos, nitritos, fosforo total, nitrogeno total",  "Nom-004-semarnat-2002",  "Nom-004: ph, conductividad, sulfatos, nitratos, cloruros, dt, sdt, cf, ca, na, k",  "Nom-127: cn",  "Nom-127-ssa1-1994/ contratar: btex, trihalometanos, fenoles, yodo residual",  "Ph, cn", "Nueva"
    ];

    const params = props.order.v_libreta_resultados ? parametersProp.map(parameter => parameter.parametro):oldParams;
    const optionsIdentificacionesMuestra = [{ value: null, label: 'Elige una identificacion de muestra'}, ...props.identificacionesMuestra.map(identificacionMuestra => {
        return { value: identificacionMuestra.id, label: identificacionMuestra.identificacion_muestra };
    })];
   
    const formStateRaw = {};
    for (let i = 0; i < props.numeroMuestras; i++) {
        formStateRaw[`tipo_muestra_${i + 1}`] = null;
    }

    const formState = useForm(formStateRaw);

    const handleSubmit = (data) => {
        console.log(data);
        /*const url = `/muestras/${props.order.folio}/${props.numeroMuestras}/${props.inicioMuestras}`;
        router.post(url, { samples: formState } );
        formState.shift();*/
    };
    const errorsNumbers = ref([]);
    const handleFinishFailed = (data) => {
        data.errorFields.forEach(error => {
            console.log(error);
            let nameArr = error.name[0].split('_');
            let number = nameArr[nameArr.length - 1];
            if (!errorsNumbers.value.includes(number)) {
                errorsNumbers.value.push(number);
                console.log(errorsNumbers.value);
            }
        });
    };
</script>

<template>
    <AdminLayout>
        <div class="w-8/12 mx-auto mt-3">
            <CreateTitle
                title="Crear muestras"
                :ownLink="`/muestras/create/${order.folio}/${numeroMuestras}`"
                :backLink="'/orders'"/>
            <Form 
                layout="vertical"
                :model="formState"
                @finishFailed="handleFinishFailed">
                <a-tabs v-model:activeKey="activeKey">
                    <a-tab-pane 
                        :key="i + 1" 
                        :tab="h('span', { class: {'bg-red-500':errorsNumbers.length > 0, 'text-red-800': errorsNumbers.includes(i + 1)} }, `Tab ${i + 1}`)"
                        v-for="i in createRange(0, numeroMuestras - 1)">
                    
                        <div 
                            class="grid grid-cols-12 gap-4"
                            :key="i">
                            <h3 class="text-center font-bold text-3xl col-span-12">Muestra MFQ-{{ order.folio }} - {{ i + inicioMuestras }}</h3>
                            <Row class="col-span-12">
                                <Col :span="12">
                                    <FormItem
                                        :label="`Tipo de muestra ${i + 1}`"
                                        :name="`tipo_muestra_${i + 1}`"
                                        :rules="[{required: true, message: 'Ingrese el tipo de muestra'}]">
                                        <Input 
                                            v-model:value="formState[`tipo_muestra_${i + 1}`]"/>
                                    </FormItem>
                                </Col>
                                <Col :span="12">
                                    <FormItem
                                        :label="`Identificacion de la muestra ${i + 1}`"
                                        :name="`identificacion_muestra_${i + 1}`"
                                        :rules="[{required: true, message: 'Elija una opcion'}]">
                                        <Select 
                                            v-model:value="formState[`identificacion_muestra_${i + 1}`]"
                                            :options="identificacionesMuestra">
                                        </Select>
                                    </FormItem>
                                </Col>
                            </Row>
                            <hr class="col-span-12 border-2 border-blue-500 my-4">  
                        </div>
                    </a-tab-pane>
                </a-tabs>
                <button class="bg-green-500 text-white rounded py-2 px-4">Enviar</button>
            </Form>
        </div>
    </AdminLayout>
</template>