<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import { ref, onBeforeMount } from "vue";
import axios from 'axios';
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Navigation, Pagination, Scrollbar, EffectFade, Autoplay, Thumbs } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/scrollbar';
import 'swiper/css/effect-fade';
import 'swiper/css/thumbs';



defineProps({
    product: {
        type: Object,
        required: true
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

const unit = ref(1);
const selectedSize = ref();
const sizes = ref([
    { name: 'S', code: '1' },
    { name: 'M', code: '2' },
    { name: 'L', code: '3' },
    { name: 'XL', code: '4' },
    { name: 'XXL', code: '5' }
]);

function addToCart() {
    form.post(route("cart.store"));
}

let newproducts2024 = ref([]);
onBeforeMount(() => {

    Promise.all([
        fetchSectionProducts(),
        // fetchSectionProducts('section2'),
        // y así sucesivamente para otras secciones
    ]).then(([data]) => {
        // Manejar los productos de cada sección
        data.forEach((product) => {
            newproducts2024.value.push(product);
        });
    });
});
const fetchSectionProducts = () => {
    return axios.get(`/products/new2024`)
        .then(response => response.data)
        .catch(error => {
            console.error(`Hubo un error al obtener los productos para la sección ${section}:`, error);
        });
};
let product = usePage().props.product.data;

const form = useForm({
    product_id: product.id,
    quantity: unit.value,
    size: selectedSize.value,
});


const modules = [Pagination, Navigation, Scrollbar, EffectFade, Autoplay, Thumbs];

let thumbsSwiper = ref(null);

const setThumbsSwiper = (swiper) => {
    thumbsSwiper.value = swiper;
};

const sliders = [

    { image: 'https://www.futbolemotion.com/imagesarticulos/228611/60/camiseta-adidas-real-madrid-primera-equipacion-authentic-2024-2025-white-2.jpg' },
    { image: 'https://www.futbolemotion.com/imagesarticulos/228611/60/camiseta-adidas-real-madrid-primera-equipacion-authentic-2024-2025-white-0.jpg' },
    { image: 'https://www.futbolemotion.com/imagesarticulos/228611/60/camiseta-adidas-real-madrid-primera-equipacion-authentic-2024-2025-white-2.jpg' },
    { image: 'https://swiperjs.com/demos/images/nature-4.jpg' },
    { image: 'https://swiperjs.com/demos/images/nature-5.jpg' },
    { image: 'https://swiperjs.com/demos/images/nature-6.jpg' },
    { image: 'https://swiperjs.com/demos/images/nature-7.jpg' },
    { image: 'https://swiperjs.com/demos/images/nature-8.jpg' },
]

</script>

<template>

    <Head :title="product.name" />

    <GuestLayout>
        <section class="bg-gray-100">
            <div class="font-sans px-4 mx-auto sm:px-6 lg:px-8 max-w-[107rem] ">
                <div class="max-lg:mx-auto">
                    <div class="grid items-start grid-cols-1 gap-8 lg:grid-cols-3 max-lg:gap-16 py-7">
                        <div class="w-full lg:col-span-2">
                            <div style="display: flex;"> <!-- Swiper Thumbs -->
                                <swiper :direction="'vertical'" :modules="modules" @swiper="setThumbsSwiper"
                                    :spaceBetween="10" :slidesPerView="4" :freeMode="true" :watchSlidesVisibility="true"
                                    :watchSlidesProgress="true" class="select-none mySwiper">
                                    <swiper-slide v-for="(slider, index) in sliders" :key="index">
                                        <div class="p-2 rounded-md shadow-lg cursor-pointer">
                                            <img :src="slider.image" />
                                        </div>
                                    </swiper-slide>

                                </swiper> <!-- Swiper Principal -->
                                <swiper
                                    :style="{ '--swiper-navigation-color': '#fff', '--swiper-pagination-color': '#fff' }"
                                    :spaceBetween="10" :navigation="true" :thumbs="{ swiper: thumbsSwiper }"
                                    :modules="modules" class="select-none mySwiper2">
                                    <swiper-slide><img
                                            src="https://www.futbolemotion.com/imagesarticulos/228611/750/camiseta-adidas-real-madrid-primera-equipacion-authentic-2024-2025-white-0.webp " /></swiper-slide>
                                    <swiper-slide><img
                                            src="https://www.futbolemotion.com/imagesarticulos/228611/60/camiseta-adidas-real-madrid-primera-equipacion-authentic-2024-2025-white-1.jpg" /></swiper-slide>
                                    <swiper-slide><img
                                            src="https://www.futbolemotion.com/imagesarticulos/228611/60/camiseta-adidas-real-madrid-primera-equipacion-authentic-2024-2025-white-2.jpg" /></swiper-slide>
                                    <swiper-slide><img
                                            src="https://swiperjs.com/demos/images/nature-4.jpg" /></swiper-slide>
                                    <swiper-slide><img
                                            src="https://swiperjs.com/demos/images/nature-5.jpg" /></swiper-slide>
                                    <swiper-slide><img
                                            src="https://swiperjs.com/demos/images/nature-6.jpg" /></swiper-slide>
                                    <swiper-slide><img
                                            src="https://swiperjs.com/demos/images/nature-7.jpg" /></swiper-slide>
                                    <swiper-slide><img
                                            src="https://swiperjs.com/demos/images/nature-8.jpg" /></swiper-slide>
                                    <swiper-slide><img
                                            src="https://swiperjs.com/demos/images/nature-9.jpg" /></swiper-slide>
                                    <swiper-slide><img
                                            src="https://swiperjs.com/demos/images/nature-10.jpg" /></swiper-slide>
                                </swiper>
                            </div>
                        </div>
                        <div class="lg:pl-8">
                            <div class="flex flex-wrap items-start gap-4">
                                <div>
                                    <h2 class="font-black text-black uppercase lg:text-4xl "> {{ product.name }}

                                    </h2>
                                    <p class="mt-2 text-sm text-gray-500">Sé el primero en opinar</p>
                                </div>
                            </div>
                            <div class="flex flex-wrap items-start gap-4">
                                <div>
                                    <p class="text-4xl font-bold text-gray-800">${{ product.price }},99</p>
                                    <p class="mt-2 text-sm text-gray-500">antes: $42
                                        <!-- <span class="ml-1 text-sm">Tax included</span> -->
                                    </p>
                                </div>
                            </div>
                            <div class="grid items-start grid-cols-2 gap-4">
                                <div>
                                    <p>Unit</p>
                                    <InputNumber v-model="unit" inputId="horizontal-buttons" showButtons
                                        buttonLayout="horizontal" :step="1" mode="decimal" fluid>
                                        <template #incrementicon>
                                            <span class="pi pi-plus" />
                                        </template>
                                        <template #decrementicon>
                                            <span class="pi pi-minus" />
                                        </template>
                                    </InputNumber>
                                </div>
                                <div class="grid-cols-1">
                                    <p>Size</p>
                                    <Select v-model="selectedSize" :options="sizes" optionLabel="name"
                                        placeholder="Select a Size" checkmark :highlightOnSelect="false"
                                        class="w-full" />

                                    <div class="flex justify-end my-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-5">
                                            <path
                                                d="M 10,452 452,10 Q 462,0 476.5,0 491,0 501.5,10 512,20 512,35 v 442 q 0,14 -10.5,24.5 Q 491,512 477,512 H 35 Q 20,512 10,501.5 0,491 0,477 0,463 10,452 Z m 22,26 q 1,2 3,2 h 442 q 3,0 3,-3 V 35 q 0,-3 -3,-3 -1,0 -2,1 l -74,74 17,17 q 2,2 2,5.5 0,3.5 -2,5.5 l -11,11 q -3,3 -6,3 -3,0 -6,-3 l -17,-17 -45,46 17,17 q 2,2 2,5.5 0,3.5 -2,5.5 l -11,11 q -3,3 -6,3 -3,0 -6,-3 l -17,-17 -45,46 17,16 q 2,3 2,6 0,3 -2,6 l -11,11 q -3,2 -6,2 -3,0 -6,-2 l -17,-17 -45,45 17,17 q 3,3 3,6 0,3 -3,6 l -11,11 q -2,2 -5.5,2 -3.5,0 -5.5,-2 l -17,-17 -46,45 17,17 q 3,3 3,6 0,3 -3,6 l -11,11 q -2,2 -5.5,2 -3.5,0 -5.5,-2 l -17,-17 -74,74 q -1,1 -1,3 z M 389,229 q 7,-8 17,-4 10,4 10,15 v 160 q 0,7 -4.5,11.5 Q 407,416 400,416 H 240 q -11,0 -15,-10 -4,-10 4,-17 z m -5,155 V 279 L 279,384 Z">
                                            </path>
                                        </svg>
                                        <a class="ml-2 text-end" href="#">¿Cual es mi talla?</a>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button class="btn-primary">
                                    Personalízalo a tu gusto
                                    <i class="ml-1 pi pi-pencil"></i>
                                </button>
                            </div>
                            <div class="mt-2">
                                <button class="btn-secondary" @click.prevent="addToCart">
                                    Add to cart
                                    <i class="ml-1 pi pi-cart-plus"></i>
                                </button>
                            </div>
                            <div>
                                <ul>
                                    <li>
                                        <div class="flex p-6 align-items-start">
                                            <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1"
                                                class="w-10" viewBox="0 0 24 24">
                                                <path
                                                    d="m24,10.5c0-2.481-2.019-4.5-4.5-4.5h-2.5v-2.5c0-1.378-1.121-2.5-2.5-2.5h-2.5v1h2.5c.827,0,1.5.673,1.5,1.5v14.5H1v-6H0v7h2.176c-.116.319-.176.656-.176,1,0,1.654,1.346,3,3,3s3-1.346,3-3c0-.344-.06-.681-.176-1h8.352c-.116.319-.176.656-.176,1,0,1.654,1.346,3,3,3s3-1.346,3-3c0-.344-.06-.681-.176-1h2.176v-8.5ZM7,20c0,1.103-.897,2-2,2s-2-.897-2-2c0-.352.095-.693.277-1h3.446c.182.307.277.648.277,1Zm12.5-13c1.93,0,3.5,1.57,3.5,3.5v1.5h-6v-5h2.5Zm1.5,13c0,1.103-.897,2-2,2s-2-.897-2-2c0-.352.095-.693.277-1h3.446c.182.307.277.648.277,1Zm-4-2v-5h6v5h-6ZM10,2H0v-1h10v1Zm-2,4H0v-1h8v1Zm-2,4H0v-1h6v1Z" />
                                            </svg>
                                            <div class="pl-3 text-start">
                                                <p class="mb-0 font-semibold fs-6">Producto con envío gratis a España
                                                    Peninsular</p>
                                                <p class="mb-0">Compra este producto y recíbelo sin pagar gastos de
                                                    envío</p>
                                            </div>
                                        </div>
                                        <hr />
                                    </li>
                                    <li>
                                        <div class="flex p-6 align-items-start">
                                            <svg class="w-10" xmlns="http://www.w3.org/2000/svg" id="Layer_1"
                                                data-name="Layer 1" viewBox="0 0 24 24">
                                                <path
                                                    d="M.848,15.494l2.075,1.476c.973,.692,2.121,1.045,3.275,1.045,.828,0,1.66-.182,2.433-.55l13.932-6.677c1.241-.593,1.781-2.09,1.203-3.338-.579-1.251-2.069-1.795-3.319-1.219l-.007,.004-4.002,1.932c-.01-.008-.02-.015-.031-.022L9.185,3.492c-.734-.546-1.708-.644-2.542-.26l-.781,.367c-.458,.215-.774,.643-.846,1.144-.072,.502,.111,1.001,.488,1.335l5.346,4.785-5.06,2.442-3.238-1.189c-.778-.282-1.651-.034-2.17,.629-.307,.393-.435,.889-.361,1.397,.079,.542,.38,1.034,.828,1.352ZM6.169,5.332c-.128-.114-.188-.276-.164-.446s.127-.309,.282-.381l.778-.365c.498-.233,1.083-.173,1.55,.174l6.769,4.362-3.561,1.719L6.169,5.332ZM1.169,13.36c.182-.231,.452-.36,.729-.36,.104,0,.208,.019,.309,.056l3.437,1.262c.127,.047,.268,.039,.39-.02l14.837-7.16c.748-.344,1.641-.018,1.989,.732,.349,.754,.022,1.658-.728,2.016l-13.932,6.677c-1.522,.725-3.322,.57-4.697-.407l-2.075-1.476c-.226-.16-.377-.409-.417-.682-.034-.235,.022-.462,.16-.638Zm22.831,10.14c0,.276-.224,.5-.5,.5H.5c-.276,0-.5-.224-.5-.5s.224-.5,.5-.5H23.5c.276,0,.5,.224,.5,.5Z" />
                                            </svg>
                                            <div class="pl-3 text-start">
                                                <p class="mb-0 font-semibold fs-6">Envios a todo el mundo</p>
                                                <p class="mb-0">
                                                    Compra este producto y recíbelo en cualquier parte del mundo
                                                </p>
                                            </div>
                                        </div>
                                        <hr />
                                    </li>
                                    <li>
                                        <div class="flex p-6 align-items-start">
                                            <svg class="w-10" xmlns="http://www.w3.org/2000/svg" id="Layer_1"
                                                data-name="Layer 1" viewBox="0 0 24 24">
                                                <path
                                                    d="M24,12.5c0,4.136-3.364,7.5-7.5,7.5H1.293l3.146,3.146c.195,.195,.195,.512,0,.707-.098,.098-.226,.146-.354,.146s-.256-.049-.354-.146L.439,20.561c-.585-.585-.585-1.536,0-2.121l3.293-3.293c.195-.195,.512-.195,.707,0s.195,.512,0,.707l-3.146,3.146h15.207c3.584,0,6.5-2.916,6.5-6.5,0-.276,.224-.5,.5-.5s.5,.224,.5,.5ZM.5,12c.276,0,.5-.224,.5-.5,0-3.584,2.916-6.5,6.5-6.5h15.207l-3.146,3.146c-.195,.195-.195,.512,0,.707,.098,.098,.226,.146,.354,.146s.256-.049,.354-.146l3.293-3.293c.585-.585,.585-1.536,0-2.121L20.268,.146c-.195-.195-.512-.195-.707,0s-.195,.512,0,.707l3.146,3.146H7.5C3.364,4,0,7.364,0,11.5c0,.276,.224,.5,.5,.5Z" />
                                            </svg>
                                            <div class="pl-3 text-start">
                                                <p class="mb-0 font-semibold fs-6">Devolucion por producto defectuoso
                                                </p>
                                                <p class="mb-0">Compra este producto y recíbelo sin pagar gastos de
                                                    envío</p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="px-4 mx-auto sm:px-6 lg:px-8 max-w-[107rem]">
            <div class="mt-14">
                <ul class="flex w-full ">
                    <li
                        class="w-full px-8 py-3 text-sm font-semibold text-center transition-all border-b-4 border-[#ffb612] cursor-pointer">
                        About product</li>
                    <li
                        class="w-full px-8 py-3 text-sm font-semibold text-center text-gray-500 hover:border-b-4 border-[#ffb612] cursor-pointer">
                        Reviews</li>
                </ul>

                <div class="mt-8">
                    <p class="font-black text-black lg:text-3xl">Product Description</p>
                    <p class="mt-4 text-sm text-gray-500">Elevate your casual style with our premium men's
                        t-shirt.
                        Crafted for comfort and designed with a modern fit, this versatile shirt is an essential
                        addition to your wardrobe. The soft and breathable fabric ensures all-day comfort,
                        making it
                        perfect for everyday wear. Its classic crew neck and short sleeves offer a timeless
                        look.
                    </p>
                </div>

                <ul class="pl-4 mt-6 space-y-3 text-sm text-gray-500 list-disc">
                    <li>A gray t-shirt is a wardrobe essential because it is so versatile.</li>
                    <li>Available in a wide range of sizes, from extra small to extra large, and even in tall
                        and
                        petite sizes.</li>
                    <li>This is easy to care for. They can usually be machine-washed and dried on low heat.</li>
                    <li>You can add your own designs, paintings, or embroidery to make it your own.</li>
                </ul>
            </div>
        </section>
        <hr class="my-5">
        <section class="px-4 mx-auto sm:px-6 lg:px-8 max-w-[107rem] ">
            <div class="py-3">
                <p class="font-black text-black lg:text-3xl">Similar Products</p>
            </div>
            <!-- New in 2024-25 -->

            <div>
                <Carousel :value="newproducts2024" :numVisible="6" :numScroll="1" :responsiveOptions="responsiveOptions"
                    :showIndicators="false">
                    <template #item="slotProps">
                        <div class="p-4">
                            <div class="mb-4">
                                <div class="relative mx-auto">
                                    <a :href="'/products/' + slotProps.data.id">
                                        <img :src="'/storage/products/' + slotProps.data.image"
                                            :alt="slotProps.data.name" class="w-full select-none max-w-60" />
                                        <p>{{ slotProps.data.name }}</p>
                                        <p class="font-semibold">${{ slotProps.data.price }}</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </template>
                </Carousel>
            </div>
        </section>


    </GuestLayout>
</template>
