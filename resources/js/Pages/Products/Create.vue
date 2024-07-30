<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from "@inertiajs/vue3";
import { watch, ref } from "vue";
import axios from "axios";
import InputError from "@/Components/InputError.vue";
import ToggleSwitch from 'primevue/toggleswitch';

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

const cards = ref([
    {}
]);

const form = useForm({

    name: null,
    image: null,
    image2: null,
    short_desc: null,
    category_id: null,
    price: null,
    stock: null,
    unlimited: true,
    variations: cards

});

// Método para actualizar el modelo de archivo de la variación
function updateFileModel(event) {
    const image = event.target.files[0];
    return form.image = image;
}

// Método para generar una vista previa del archivo seleccionado
function previewImage(image) {

    return URL.createObjectURL(image);
}

const createProduct = () => {
    form.post(route("products.store"))
};

function addVariation() {
    cards.value.push({ options: [] });
}

const page = ref(0);
const removeVariation = (index) => {
    cards.value.splice(index, 1);
    page.value = 0;
};

const variationOptions = ref([]);

const getVariationOptions = async (variation_id, slotIndex) => {
    try {
        variationOptions.value[slotIndex] = [];
        cards.value[slotIndex].options = null;
        const response = await axios.get(`/api/variationOptions?variation_id=${variation_id}`);
        variationOptions.value[slotIndex] = response.data.data;
    } catch (error) {
        console.error("Error fetching variation options:", error);
        // Aquí puedes manejar el error, por ejemplo, mostrando un mensaje al usuario
    }
};
// watcher cards uplaod to form
watch(cards, (value) => {
    form.variations = value;
}, { deep: true });

</script>

<template>

    <Head title="Products list" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Products</h2>
        </template>

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
                                                <label class="block text-sm font-medium text-gray-700">Quantity in
                                                    Stock</label>
                                                <InputNumber class="w-full" v-model="form.stock" />
                                                <InputError class="mt-2" :message="form.errors.stock" />
                                            </div>

                                            <div class="col-span-6 sm:col-span-6">
                                                <label
                                                    class="block text-sm font-medium text-gray-700">Description</label>
                                                <Textarea class="w-full" v-model="form.short_desc" rows="5" cols="30"
                                                    id="short_desc" />
                                                <InputError class="mt-2" :message="form.errors.short_desc" />
                                            </div>

                                            <div class="col-span-6 sm:col-span-6">
                                                <label class="block text-sm font-medium text-gray-700">Unlimited</label>
                                                <ToggleSwitch v-model="form.unlimited" />
                                            </div>
                                            <div class="col-span-6 sm:col-span-6">
                                                <div class="flex items-center space-x-6">

                                                    <div v-if="form.image">
                                                        <img :src="previewImage(form.image)"
                                                            class="object-cover w-16 h-16 rounded" alt="Preview">
                                                    </div>
                                                    <div v-else>
                                                        <img src="https://media.istockphoto.com/id/931643150/vector/picture-icon.jpg?s=612x612&w=0&k=20&c=St-gpRn58eIa8EDAHpn_yO4CZZAnGD6wKpln9l3Z3Ok="
                                                            class="object-cover rounded w-[4rem]" alt="Preview">
                                                    </div>
                                                    <FileUpload mode="basic" :customUpload="true"
                                                        @input="form.image = $event.target.files[0]" accept="image/*">
                                                    </FileUpload>
                                                    <InputError class="mt-2" :message="form.errors.image" />
                                                </div>

                                                <div class="flex items-center mt-5 space-x-6">

                                                    <div v-if="form.image2">
                                                        <img :src="previewImage(form.image2)"
                                                            class="object-cover w-16 h-16 rounded" alt="Preview">
                                                    </div>
                                                    <div v-else>
                                                        <img src="https://media.istockphoto.com/id/931643150/vector/picture-icon.jpg?s=612x612&w=0&k=20&c=St-gpRn58eIa8EDAHpn_yO4CZZAnGD6wKpln9l3Z3Ok="
                                                            class="object-cover rounded w-[4rem]" alt="Preview">
                                                    </div>
                                                    <FileUpload mode="basic" :customUpload="true"
                                                        @input="form.image2 = $event.target.files[0]" accept="image/*">
                                                    </FileUpload>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- Sección de la tarjeta -->
                                    <div class="w-1/2 p-4">
                                        <Carousel :key="cards.length" :value="cards" :numVisible="1" :numScroll="1"
                                            :responsiveOptions="responsiveOptions">
                                            <template #item="{ index: slotIndex }">
                                                <Card style="width: 25rem; overflow: hidden" class="mx-auto">
                                                    <template #title>Variants</template>
                                                    <template #subtitle>
                                                        Option {{ slotIndex + 1 }}
                                                        <a v-if="cards.length != 1" href="#"
                                                            class="ml-1 font-semibold text-green-500"
                                                            @click.prevent="removeVariation(slotIndex)">Remove</a>
                                                    </template>
                                                    <template #content>
                                                        <div class="grid grid-cols-12 gap-5">
                                                            <div class="col-span-12 sm:col-span-12">
                                                                <Select
                                                                    @change="getVariationOptions($event.value, slotIndex)"
                                                                    v-model="cards[slotIndex].variation"
                                                                    :options="variations" optionValue="id"
                                                                    class="w-full" optionLabel="name"
                                                                    placeholder="Select a variant" />
                                                            </div>
                                                            <div class="col-span-12 sm:col-span-12">
                                                                <MultiSelect v-model="cards[slotIndex].options"
                                                                    :options="variationOptions[slotIndex]"
                                                                    optionValue="id" optionLabel="name"
                                                                    placeholder="Select options" class="w-full" />
                                                                <InputError class="mt-2"
                                                                    :message="form.errors.options" />
                                                            </div>
                                                            <div class="col-span-12 sm:col-span-12">
                                                                <InputNumber placeholder="Variant increment price"
                                                                    class="w-full"
                                                                    v-model="cards[slotIndex].variation_price"
                                                                    :minFractionDigits="2" :maxFractionDigits="2" />
                                                                <InputError class="mt-2"
                                                                    :message="form.errors.variation_price" />
                                                            </div>
                                                        </div>
                                                    </template>
                                                    <template #footer>
                                                        <div class="flex gap-3 mt-1">
                                                            <Button @click.prevent="addVariation"
                                                                label="Add another variant" class="w-full" />
                                                        </div>
                                                    </template>
                                                </Card>
                                            </template>
                                        </Carousel>

                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
                                <Link :href="route('products.index')">
                                <Button class="mr-4" label="Cancel" severity="secondary" outlined />
                                </Link>

                                <Button type="submit" label="Save" />
                            </div>
                        </div>
                    </form>

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
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
