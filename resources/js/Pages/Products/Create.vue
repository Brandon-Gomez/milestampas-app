<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from "@inertiajs/vue3";
import { watch, ref } from "vue";
import axios from "axios";
import InputError from "@/Components/InputError.vue";
import { useToast } from 'primevue/usetoast';
import TabPanel from 'primevue/tabpanel';

const props = defineProps({
    categories: {
        type: Object,
    },
    variations: {
        type: Object
    }
});

const responsiveOptions = ref([
    {
        breakpoint: '1400px',
        numVisible: 2,
        numScroll: 1
    },
    {
        breakpoint: '1199px',
        numVisible: 3,
        numScroll: 1
    },
    {
        breakpoint: '767px',
        numVisible: 2,
        numScroll: 1
    },
    {
        breakpoint: '575px',
        numVisible: 1,
        numScroll: 1
    }
]);

// Suponiendo que `vars` es tu lista de tarjetas en el carrusel
const vars = ref([
    {
        variation: '',
        options: []

    }
]);

const form = useForm({
    name: "",
    file: "",
    description: "",
    category_id: "",
    price: 0.00,
    stock: 0,
});


// Método para actualizar el modelo de archivo de la variación
function updateFileModel(event, variationId = null) {
    const file = event.target.files[0];
    if (variationId) {

        return objvariations.value[variationId].file = file;
    }
    return form.file = file;
}

// Método para generar una vista previa del archivo seleccionado
function previewVariationImage(variationId) {
    if (objvariations.value[variationId].file) {
        return URL.createObjectURL(objvariations.value[variationId].file);
    }
    return ''; // URL de una imagen por defecto o dejar vacío
}

function previewImage() {
    if (form.file) {
        return URL.createObjectURL(form.file);
    }
    return ''; // URL de una imagen por defecto o dejar vacío
}

const createProduct = () => {
    form.post(route("products.store"))
};

function addVariation() {
    vars.value.push({ variation: '', options: [] });
}

const removeVariation = (index) => {
    vars.value.splice(index, 1);
};
// Watcher para actualizar las opciones del MultiSelect basado en la selección del Select
// vars.value.forEach((varCard, index) => {
//     watch(() => varCard.variation, (newVal) => {
//         const selectedVariation = variations.value.find(v => v.id === newVal);
//         if (selectedVariation) {
//             vars.value[index].options = selectedVariation.multiSelectOptions;
//         }
//     });
// });

const variationOptions = ref([]);

const getVariationOptions = async (variation_id, slotIndex) => {
    try {
        const response = await axios.get(`/api/variationOptions?variation_id=${variation_id}`);
        console.log(response.data);
        // variationOptions.value = response.data;
        // vars.value[slotIndex].options = variationOptions.value.data;
    } catch (error) {
        console.error("Error fetching variation options:", error);
        // Aquí puedes manejar el error, por ejemplo, mostrando un mensaje al usuario
    }
};

</script>

<template>

    <Head title="Products list" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Products</h2>
        </template>

        <Toast />
        <!-- content -->

        <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-12 lg:gap-x-5">
                <div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-12">
                    <form @submit.prevent="createProduct" enctype="multipart/form-data">
                        <div class="shadow sm:rounded-md sm:overflow-hidden">
                            <div class="px-4 py-6 space-y-6 bg-white sm:p-6">
                                <div>
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                                        Product Information
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-500">
                                        Use this form to create a new product.
                                    </p>
                                </div>


                                <div class="flex">
                                    <!-- Sección de inputs -->
                                    <div class="w-1/2 p-4">
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6 sm:col-span-6">
                                                <label class="block text-sm font-medium text-gray-700">Name</label>

                                                <InputText class="w-full" type="text" v-model="form.name" id="name"
                                                    :class="{
                                                        'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300':
                                                            form.errors.name,
                                                    }" />
                                                <InputError class="mt-2" :message="form.errors.name" />
                                            </div>
                                            <div class="col-span-6 sm:col-span-6">
                                                <label class="block text-sm font-medium text-gray-700">Category</label>
                                                <Select v-model="form.category_id" :options="categories.data"
                                                    optionValue="id" optionLabel="name" placeholder="Select a category"
                                                    class="w-full" />
                                                <InputError class="mt-2" :message="form.errors.category_id" />
                                            </div>
                                            <div class="col-span-6 sm:col-span-6">
                                                <label class="block text-sm font-medium text-gray-700">Price</label>
                                                <InputNumber v-model="form.price" :minFractionDigits="2"
                                                    :maxFractionDigits="2" class="w-full" />
                                                <InputError class="mt-2" :message="form.errors.price" />

                                            </div>
                                            <div class="col-span-6 sm:col-span-6">
                                                <label class="block text-sm font-medium text-gray-700">Stock</label>
                                                <InputNumber class="w-full" v-model="form.stock" />
                                                <InputError class="mt-2" :message="form.errors.price" />

                                            </div>
                                            <div class="col-span-6 sm:col-span-6">
                                                <label
                                                    class="block text-sm font-medium text-gray-700">Description</label>
                                                <Textarea class="w-full" v-model="form.description" rows="5" cols="30"
                                                    id="description" />
                                                <InputError class="mt-2" :message="form.errors.description" />
                                            </div>
                                            <div class="col-span-6 sm:col-span-6">
                                                <div class="flex items-center space-x-6">
                                                    <div class="shrink-0">
                                                        <div v-if="form.file">
                                                            <img :src="previewImage()"
                                                                class="object-cover w-16 h-16 rounded" alt="Preview">
                                                        </div>
                                                        <div v-else>
                                                            <img src="https://media.istockphoto.com/id/931643150/vector/picture-icon.jpg?s=612x612&w=0&k=20&c=St-gpRn58eIa8EDAHpn_yO4CZZAnGD6wKpln9l3Z3Ok="
                                                                class="object-cover w-16 h-16 rounded" alt="Preview">
                                                        </div>
                                                    </div>

                                                    <label class="block">
                                                        <input type="file" @change="updateFileModel($event)"
                                                            class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-500 hover:file:bg-green-100 " />
                                                        <InputError class="mt-2" :message="form.errors.image" />
                                                    </label>
                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                    <!-- Sección de la tarjeta -->
                                    <div class="w-1/2 p-4">
                                        {{ vars }}
                                        <Carousel :value="vars" :numVisible="1" :numScroll="1"
                                            :responsiveOptions="responsiveOptions">
                                            <template #item="{ index: slotIndex }">
                                                <Card style="width: 25rem; overflow: hidden" class="mx-auto">
                                                    <template #title>Variants</template>
                                                    <template #subtitle>
                                                        Option {{ slotIndex + 1 }}

                                                        <a href="#" class="font-semibold text-green-500"
                                                            @click.prevent="removeVariation(slotIndex)">Remove</a>
                                                    </template>
                                                    <template #content>
                                                        <Select @change="getVariationOptions($event.value, slotIndex)"
                                                            v-model="vars[slotIndex].variation" :options="variations"
                                                            optionValue="id" optionLabel="name"
                                                            placeholder="Select a variant" class="w-full mb-3" />
                                                        <MultiSelect v-model="vars.options" optionValue="id"
                                                            optionLabel="name" placeholder="Select options" />
                                                    </template>
                                                    <template #footer>
                                                        <div class="flex gap-3 mt-1">
                                                            <Button @click.prevent="addVariation"
                                                                label="Add another option" class="w-full" />
                                                        </div>
                                                    </template>
                                                </Card>
                                            </template>
                                        </Carousel>

                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
                                <Link :href="route('products.index')"
                                    class="inline-flex items-center px-4 py-2 mr-4 text-sm font-medium text-indigo-700 bg-indigo-100 border border-transparent rounded-md hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Cancel
                                </Link>
                                <button type="submit"
                                    class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Save
                                </button>
                            </div>
                        </div>

                        <!-- tabs -->
                        <!-- <Tabs value="1">
                            <TabList>
                                <Tab class="capitalize" v-for="variation in variations"
                                    :value="variation.id.toString()">
                                    {{ variation.name }}
                                </Tab>
                                <Tab>

                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </Tab>
                            </TabList>
                            <TabPanels>
                                <TabPanel v-for="variation in variations" :value="variation.id.toString()">
                                    <p class="m-0 ">

                                    <div class="col-span-6 sm:col-span-3">
                                        <label class="block text-sm font-medium text-gray-700">Variation
                                            option</label>
                                        <MultiSelect v-model="objvariations[variation.id].options"
                                            :options="variation.variation_options" optionValue="id" optionLabel="name"
                                            placeholder="Select options" />
                                    </div>
                                    <div class="my-3">
                                        <label class="block text-sm font-medium text-gray-700">Price</label>
                                        <InputNumber v-model="objvariations[variation.id].price" :minFractionDigits="2"
                                            :maxFractionDigits="2" />
                                    </div>

                                    <div class="flex items-center space-x-6">
                                        <div class="shrink-0">
                                            <div v-if="objvariations[[variation.id]].file">
                                                <img :src="previewVariationImage(variation.id)"
                                                    class="object-cover w-16 h-16 rounded" alt="Preview">
                                            </div>
                                            <div v-else>
                                                <img src="https://media.istockphoto.com/id/931643150/vector/picture-icon.jpg?s=612x612&w=0&k=20&c=St-gpRn58eIa8EDAHpn_yO4CZZAnGD6wKpln9l3Z3Ok="
                                                    class="object-cover w-16 h-16 rounded" alt="Preview">
                                            </div>
                                        </div>

                                        <label class="block">
                                            <input type="file" @change="updateFileModel($event, variation.id)"
                                                class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-500 hover:file:bg-green-100" />
                                        </label>
                                    </div>
                                    </p>
                                </TabPanel>
                                <TabPanel>

                                    <Select v-model="form.category_id" :options="categories.data" optionValue="id"
                                        optionLabel="name" placeholder="Select a category" class="w-full" />
                                </TabPanel>
                            </TabPanels>
                        </Tabs> -->
                    </form>
                </div>
            </div>
        </div>



    </AuthenticatedLayout>
</template>
