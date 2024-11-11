<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from "vue";


defineProps({
    product: {
        type: Object,
        required: true
    }
});

const unit = ref(1);
const selectedSize = ref();
const sizes = ref([
    { name: 'S', code: '1' },
    { name: 'M', code: '2' },
    { name: 'L', code: '3' },
    { name: 'XL', code: '4' },
    { name: 'XXL', code: '5' }
]);


</script>

<template>

    <Head title="Producto" />

    <GuestLayout>

        <section class="bg-gray-100">
            <div class="font-sans px-4 mx-auto sm:px-6 lg:px-8 max-w-[107rem] ">
                <div class="max-lg:mx-auto">
                    <div class="grid items-start grid-cols-1 gap-8 lg:grid-cols-3 max-lg:gap-16 py-7">
                        <div class="top-0 flex flex-row w-full lg:col-span-2">
                            <div class="hidden lg:block">
                                <div class="p-1 mb-4 bg-white rounded shadow-sm">
                                    <img src="https://www.futbolemotion.com/imagesarticulos/228611/60/camiseta-adidas-real-madrid-primera-equipacion-authentic-2024-2025-white-0.jpg"
                                        alt="" style="max-width: 60px; max-height: 60px">
                                </div>
                                <div class="p-1 mb-4 bg-white rounded shadow-sm">
                                    <img src="https://www.futbolemotion.com/imagesarticulos/228611/60/camiseta-adidas-real-madrid-primera-equipacion-authentic-2024-2025-white-0.jpg"
                                        alt="" style="max-width: 60px; max-height: 60px">
                                </div>
                                <div class="p-1 mb-4 bg-white rounded shadow-sm">
                                    <img src="https://www.futbolemotion.com/imagesarticulos/228611/60/camiseta-adidas-real-madrid-primera-equipacion-authentic-2024-2025-white-0.jpg"
                                        alt="" style="max-width: 60px; max-height: 60px">
                                </div>

                            </div>

                            <div class="mx-auto">
                                <img fetchpriority="high" width="750" height="750"
                                    class="object-cover object-top rounded-md img-fluid w-auto-ratio lg:w-11/12 "
                                    src="https://www.futbolemotion.com/imagesarticulos/228611/750/camiseta-adidas-real-madrid-primera-equipacion-authentic-2024-2025-white-0.webp"
                                    alt="camiseta-adidas-real-madrid-primera-equipacion-authentic-2024-2025-white-0">
                            </div>
                        </div>

                        <div class="lg:pl-8">
                            <div class="flex flex-wrap items-start gap-4">
                                <div>
                                    <h2 class="font-black text-gray-800 uppercase lg:text-4xl ">Camiseta
                                        adidas Real Madrid
                                        Primera
                                        Equipación Authentic 2024-2025
                                    </h2>
                                    <p class="mt-2 text-sm text-gray-500">Sé el primero en opinar</p>
                                </div>

                            </div>

                            <div class="flex flex-wrap items-start gap-4">
                                <div>
                                    <p class="text-4xl font-bold text-gray-800">$30</p>
                                    <p class="mt-2 text-sm text-gray-500">antes: <strike>$42</strike>
                                        <!-- <span class="ml-1 text-sm">Tax included</span> -->
                                    </p>
                                </div>



                            </div>
                            <div class="grid items-start grid-cols-2 gap-4">
                                <div>
                                    <p>Unit</p>

                                    <InputNumber v-model="unit" inputId="horizontal-buttons" showButtons
                                        buttonLayout="horizontal" :step="1" mode="decimal" fluid max="10">
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
                                <button class="btn-secondary">
                                    Añadir al carrito
                                    <i class="ml-1 pi pi-cart-plus"></i>
                                </button>
                            </div>
                            <hr class="my-8" />
                            <div>
                                <ul>
                                    <li>


                                        <div class="flex align-items-start">
                                            <i class="uit uit-truck"></i>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-12">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                                            </svg>
                                            <div class="text-start">
                                                <p class="mb-0 fw-bold fs-6">Producto con envío gratis a España
                                                    Peninsular</p>
                                                <p class="mb-0">Compra este producto y recíbelo sin pagar gastos de
                                                    envío</p>
                                            </div>
                                        </div>



                                    </li>
                                </ul>
                            </div>

                            <div>
                                <h3 class="text-xl font-bold text-gray-800">Choose a Color</h3>
                                <div class="flex flex-wrap gap-4 mt-4">
                                    <button type="button"
                                        class="w-10 h-10 bg-black border border-white rounded-md hover:border-gray-800 shrink-0"></button>
                                    <button type="button"
                                        class="w-10 h-10 bg-gray-400 border border-white rounded-md hover:border-gray-800 shrink-0"></button>
                                    <button type="button"
                                        class="w-10 h-10 bg-orange-400 border border-white rounded-md hover:border-gray-800 shrink-0"></button>
                                    <button type="button"
                                        class="w-10 h-10 bg-red-400 border border-white rounded-md hover:border-gray-800 shrink-0"></button>
                                </div>
                            </div>

                            <hr class="my-8" />

                            <div class="flex flex-wrap gap-4">
                                <button type="button"
                                    class="min-w-[200px] px-4 py-3 bg-gray-800 hover:bg-gray-900 text-white text-sm font-semibold rounded-md">Buy
                                    now</button>
                                <button type="button"
                                    class="min-w-[200px] px-4 py-2.5 border border-gray-800 bg-transparent hover:bg-gray-50 text-gray-800 text-sm font-semibold rounded-md">Add
                                    to cart</button>
                            </div>
                        </div>
                    </div>

                    <div class="max-w-4xl mt-20">
                        <ul class="flex border-b">
                            <li
                                class="px-8 py-3 text-sm font-semibold text-gray-800 transition-all bg-gray-100 border-b-2 border-gray-800 cursor-pointer">
                                Description</li>
                            <li
                                class="px-8 py-3 text-sm font-semibold text-gray-500 transition-all cursor-pointer hover:bg-gray-100">
                                Reviews</li>
                        </ul>

                        <div class="mt-8">
                            <h3 class="text-xl font-bold text-gray-800">Product Description</h3>
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
                </div>
            </div>
        </section>


        <section>
            <div class="bg-white">
                <div class="flex flex-row">




                    <!-- <div class="w-2/3 lg:w-2/3 xl:w-3/5 2xl:w-6/12 position-relative">
                        <div class="text-center swiper-slide px-lg-5 swiper-slide-active" data-type="image"
                            style="width: 1062px;">
                            <a data-type="images" data-pswp-width="1200" data-pswp-height="1200"
                                href="https://www.futbolemotion.com/imagesarticulos/228611/grandes/camiseta-adidas-real-madrid-primera-equipacion-authentic-2024-2025-white-0.webp"
                                data-title="camiseta-adidas-real-madrid-primera-equipacion-authentic-2024-2025-white-0"
                                data-control="prod-228611" target="_blank">
                                <div class="item">
                                    <picture data-control="prod-228611">
                                        <img fetchpriority="high" width="750" height="750"
                                            class="img-fluid w-auto-ratio"
                                            src="https://www.futbolemotion.com/imagesarticulos/228611/750/camiseta-adidas-real-madrid-primera-equipacion-authentic-2024-2025-white-0.webp"
                                            alt="camiseta-adidas-real-madrid-primera-equipacion-authentic-2024-2025-white-0">
                                    </picture>
                                </div>
                            </a>
                        </div>
                    </div> -->
                </div>
            </div>
        </section>

        <!-- <div class="font-sans px-4 mx-auto sm:px-6 lg:px-8 max-w-[107rem] my-10">
            <div class="max-w-2xl p-4 lg:max-w-6xl max-lg:mx-auto">
                <div class="grid items-start grid-cols-1 gap-8 lg:grid-cols-2 max-lg:gap-16">
                    <div class="top-0 w-full text-center lg:sticky">
                        <div class="lg:h-[560px]">
                            <img src="https://readymadeui.com/images/product6.webp" alt="Product"
                                class="object-cover object-top w-full h-full rounded-md lg:w-11/12" />
                        </div>

                        <div class="flex flex-wrap justify-center gap-4 mx-auto mt-4">
                            <img src="https://readymadeui.com/images/product6.webp" alt="Product1"
                                class="w-16 rounded-md cursor-pointer outline" />
                            <img src="https://readymadeui.com/images/product8.webp" alt="Product2"
                                class="w-16 rounded-md cursor-pointer" />
                            <img src="https://readymadeui.com/images/product5.webp" alt="Product3"
                                class="w-16 rounded-md cursor-pointer" />
                            <img src="https://readymadeui.com/images/product7.webp" alt="Product4"
                                class="w-16 rounded-md cursor-pointer" />
                        </div>
                    </div>

                    <div>
                        <div class="flex flex-wrap items-start gap-4">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800">Adjective Attire | T-shirt</h2>
                                <p class="mt-2 text-sm text-gray-500">Well-Versed Commerce</p>
                            </div>

                            <div class="flex flex-wrap gap-4 ml-auto">
                                <button type="button"
                                    class="px-2.5 py-1.5 bg-pink-100 text-xs text-pink-600 rounded-md flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12px" fill="currentColor"
                                        class="mr-1" viewBox="0 0 64 64">
                                        <path
                                            d="M45.5 4A18.53 18.53 0 0 0 32 9.86 18.5 18.5 0 0 0 0 22.5C0 40.92 29.71 59 31 59.71a2 2 0 0 0 2.06 0C34.29 59 64 40.92 64 22.5A18.52 18.52 0 0 0 45.5 4ZM32 55.64C26.83 52.34 4 36.92 4 22.5a14.5 14.5 0 0 1 26.36-8.33 2 2 0 0 0 3.27 0A14.5 14.5 0 0 1 60 22.5c0 14.41-22.83 29.83-28 33.14Z"
                                            data-original="#000000"></path>
                                    </svg>
                                    100
                                </button>
                                <button type="button"
                                    class="px-2.5 py-1.5 bg-gray-100 text-xs text-gray-800 rounded-md flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12px" fill="currentColor"
                                        viewBox="0 0 512 512">
                                        <path
                                            d="M453.332 85.332c0 38.293-31.039 69.336-69.332 69.336s-69.332-31.043-69.332-69.336C314.668 47.043 345.707 16 384 16s69.332 31.043 69.332 69.332zm0 0"
                                            data-original="#000000" />
                                        <path
                                            d="M384 170.668c-47.063 0-85.332-38.273-85.332-85.336C298.668 38.273 336.938 0 384 0s85.332 38.273 85.332 85.332c0 47.063-38.27 85.336-85.332 85.336zM384 32c-29.418 0-53.332 23.938-53.332 53.332 0 29.398 23.914 53.336 53.332 53.336s53.332-23.938 53.332-53.336C437.332 55.938 413.418 32 384 32zm69.332 394.668C453.332 464.957 422.293 496 384 496s-69.332-31.043-69.332-69.332c0-38.293 31.039-69.336 69.332-69.336s69.332 31.043 69.332 69.336zm0 0"
                                            data-original="#000000" />
                                        <path
                                            d="M384 512c-47.063 0-85.332-38.273-85.332-85.332 0-47.063 38.27-85.336 85.332-85.336s85.332 38.273 85.332 85.336c0 47.059-38.27 85.332-85.332 85.332zm0-138.668c-29.418 0-53.332 23.938-53.332 53.336C330.668 456.063 354.582 480 384 480s53.332-23.938 53.332-53.332c0-29.398-23.914-53.336-53.332-53.336zM154.668 256c0 38.293-31.043 69.332-69.336 69.332C47.043 325.332 16 294.293 16 256s31.043-69.332 69.332-69.332c38.293 0 69.336 31.039 69.336 69.332zm0 0"
                                            data-original="#000000" />
                                        <path
                                            d="M85.332 341.332C38.273 341.332 0 303.062 0 256s38.273-85.332 85.332-85.332c47.063 0 85.336 38.27 85.336 85.332s-38.273 85.332-85.336 85.332zm0-138.664C55.914 202.668 32 226.602 32 256s23.914 53.332 53.332 53.332c29.422 0 53.336-23.934 53.336-53.332s-23.914-53.332-53.336-53.332zm0 0"
                                            data-original="#000000" />
                                        <path
                                            d="M135.703 245.762c-7.426 0-14.637-3.864-18.562-10.774-5.825-10.218-2.239-23.254 7.98-29.101l197.95-112.852c10.218-5.867 23.253-2.281 29.1 7.977 5.825 10.218 2.24 23.254-7.98 29.101L146.238 242.965a21.195 21.195 0 0 1-10.535 2.797zm197.93 176c-3.586 0-7.211-.899-10.54-2.797L125.142 306.113c-10.22-5.824-13.801-18.86-7.977-29.101 5.8-10.239 18.856-13.844 29.098-7.977l197.953 112.852c10.219 5.824 13.8 18.86 7.976 29.101-3.945 6.91-11.156 10.774-18.558 10.774zm0 0"
                                            data-original="#000000" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <hr class="my-8" />

                        <div class="flex flex-wrap items-start gap-4">
                            <div>
                                <p class="text-4xl font-bold text-gray-800">$30</p>
                                <p class="mt-2 text-sm text-gray-500"><strike>$42</strike> <span
                                        class="ml-1 text-sm">Tax included</span></p>
                            </div>

                            <div class="flex flex-wrap gap-4 ml-auto">
                                <button type="button"
                                    class="px-2.5 py-1.5 bg-pink-100 text-xs text-pink-600 rounded-md flex items-center">
                                    <svg class="w-3 mr-1" fill="currentColor" viewBox="0 0 14 13"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                    </svg>
                                    4.8
                                </button>
                                <button type="button"
                                    class="px-2.5 py-1.5 bg-gray-100 text-xs text-gray-800 rounded-md flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 mr-1" fill="currentColor"
                                        viewBox="0 0 32 32">
                                        <path
                                            d="M14.236 21.954h-3.6c-.91 0-1.65-.74-1.65-1.65v-7.201c0-.91.74-1.65 1.65-1.65h3.6a.75.75 0 0 1 .75.75v9.001a.75.75 0 0 1-.75.75zm-3.6-9.001a.15.15 0 0 0-.15.15v7.2a.15.15 0 0 0 .15.151h2.85v-7.501z"
                                            data-original="#000000" />
                                        <path
                                            d="M20.52 21.954h-6.284a.75.75 0 0 1-.75-.75v-9.001c0-.257.132-.495.348-.633.017-.011 1.717-1.118 2.037-3.25.18-1.184 1.118-2.089 2.28-2.201a2.557 2.557 0 0 1 2.17.868c.489.56.71 1.305.609 2.042a9.468 9.468 0 0 1-.678 2.424h.943a2.56 2.56 0 0 1 1.918.862c.483.547.708 1.279.617 2.006l-.675 5.401a2.565 2.565 0 0 1-2.535 2.232zm-5.534-1.5h5.533a1.06 1.06 0 0 0 1.048-.922l.675-5.397a1.046 1.046 0 0 0-1.047-1.182h-2.16a.751.751 0 0 1-.648-1.13 8.147 8.147 0 0 0 1.057-3 1.059 1.059 0 0 0-.254-.852 1.057 1.057 0 0 0-.795-.365c-.577.052-.964.435-1.04.938-.326 2.163-1.71 3.507-2.369 4.036v7.874z"
                                            data-original="#000000" />
                                        <path
                                            d="M4 31.75a.75.75 0 0 1-.612-1.184c1.014-1.428 1.643-2.999 1.869-4.667.032-.241.055-.485.07-.719A14.701 14.701 0 0 1 1.25 15C1.25 6.867 7.867.25 16 .25S30.75 6.867 30.75 15 24.133 29.75 16 29.75a14.57 14.57 0 0 1-5.594-1.101c-2.179 2.045-4.61 2.81-6.281 3.09A.774.774 0 0 1 4 31.75zm12-30C8.694 1.75 2.75 7.694 2.75 15c0 3.52 1.375 6.845 3.872 9.362a.75.75 0 0 1 .217.55c-.01.373-.042.78-.095 1.186A11.715 11.715 0 0 1 5.58 29.83a10.387 10.387 0 0 0 3.898-2.37l.231-.23a.75.75 0 0 1 .84-.153A13.072 13.072 0 0 0 16 28.25c7.306 0 13.25-5.944 13.25-13.25S23.306 1.75 16 1.75z"
                                            data-original="#000000" />
                                    </svg>
                                    87 Reviews
                                </button>
                            </div>
                        </div>

                        <hr class="my-8" />

                        <div>
                            <h3 class="text-xl font-bold text-gray-800">Choose a Size</h3>
                            <div class="flex flex-wrap gap-4 mt-4">
                                <button type="button"
                                    class="flex items-center justify-center w-10 h-10 text-sm font-semibold border rounded-md hover:border-gray-800 shrink-0">SM</button>
                                <button type="button"
                                    class="flex items-center justify-center w-10 h-10 text-sm font-semibold border border-gray-800 rounded-md hover:border-gray-800 shrink-0">MD</button>
                                <button type="button"
                                    class="flex items-center justify-center w-10 h-10 text-sm font-semibold border rounded-md hover:border-gray-800 shrink-0">LG</button>
                                <button type="button"
                                    class="flex items-center justify-center w-10 h-10 text-sm font-semibold border rounded-md hover:border-gray-800 shrink-0">XL</button>
                            </div>
                        </div>

                        <hr class="my-8" />

                        <div>
                            <h3 class="text-xl font-bold text-gray-800">Choose a Color</h3>
                            <div class="flex flex-wrap gap-4 mt-4">
                                <button type="button"
                                    class="w-10 h-10 bg-black border border-white rounded-md hover:border-gray-800 shrink-0"></button>
                                <button type="button"
                                    class="w-10 h-10 bg-gray-400 border border-white rounded-md hover:border-gray-800 shrink-0"></button>
                                <button type="button"
                                    class="w-10 h-10 bg-orange-400 border border-white rounded-md hover:border-gray-800 shrink-0"></button>
                                <button type="button"
                                    class="w-10 h-10 bg-red-400 border border-white rounded-md hover:border-gray-800 shrink-0"></button>
                            </div>
                        </div>

                        <hr class="my-8" />

                        <div class="flex flex-wrap gap-4">
                            <button type="button"
                                class="min-w-[200px] px-4 py-3 bg-gray-800 hover:bg-gray-900 text-white text-sm font-semibold rounded-md">Buy
                                now</button>
                            <button type="button"
                                class="min-w-[200px] px-4 py-2.5 border border-gray-800 bg-transparent hover:bg-gray-50 text-gray-800 text-sm font-semibold rounded-md">Add
                                to cart</button>
                        </div>
                    </div>
                </div>

                <div class="max-w-4xl mt-20">
                    <ul class="flex border-b">
                        <li
                            class="px-8 py-3 text-sm font-semibold text-gray-800 transition-all bg-gray-100 border-b-2 border-gray-800 cursor-pointer">
                            Description</li>
                        <li
                            class="px-8 py-3 text-sm font-semibold text-gray-500 transition-all cursor-pointer hover:bg-gray-100">
                            Reviews</li>
                    </ul>

                    <div class="mt-8">
                        <h3 class="text-xl font-bold text-gray-800">Product Description</h3>
                        <p class="mt-4 text-sm text-gray-500">Elevate your casual style with our premium men's t-shirt.
                            Crafted for comfort and designed with a modern fit, this versatile shirt is an essential
                            addition to your wardrobe. The soft and breathable fabric ensures all-day comfort, making it
                            perfect for everyday wear. Its classic crew neck and short sleeves offer a timeless look.
                        </p>
                    </div>

                    <ul class="pl-4 mt-6 space-y-3 text-sm text-gray-500 list-disc">
                        <li>A gray t-shirt is a wardrobe essential because it is so versatile.</li>
                        <li>Available in a wide range of sizes, from extra small to extra large, and even in tall and
                            petite sizes.</li>
                        <li>This is easy to care for. They can usually be machine-washed and dried on low heat.</li>
                        <li>You can add your own designs, paintings, or embroidery to make it your own.</li>
                    </ul>
                </div>
            </div>
        </div> -->
    </GuestLayout>
</template>
