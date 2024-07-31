<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { Swiper, SwiperSlide } from 'swiper/vue';
import { ref } from 'vue'
import {
    Dialog,
    DialogPanel,
    Popover,
    PopoverButton,
    PopoverGroup,
    PopoverPanel,
    Tab,
    TabGroup,
    TabList,
    TabPanel,
    TabPanels,
    TransitionChild,
    TransitionRoot,
} from '@headlessui/vue'
import { Bars3Icon, MagnifyingGlassIcon, ShoppingBagIcon, XMarkIcon, UserIcon } from '@heroicons/vue/24/outline'

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});


const navigation = {
    categories: [
        {
            id: 'national',
            name: 'National',
            featured: [
                {
                    name: 'New Arrivals',
                    href: '#',
                    imageSrc: 'https://tailwindui.com/img/ecommerce-images/mega-menu-category-01.jpg',
                    imageAlt: 'Models sitting back to back, wearing Basic Tee in black and bone.',
                },
                {
                    name: 'Basic Tees',
                    href: '#',
                    imageSrc: 'https://tailwindui.com/img/ecommerce-images/mega-menu-category-02.jpg',
                    imageAlt: 'Close up of Basic Tee fall bundle with off-white, ochre, olive, and black tees.',
                },
            ],
            sections: [
                {
                    id: 'clothing',
                    name: 'European',
                    items: [
                        { name: 'Tops', href: '#' },
                        { name: 'Dresses', href: '#' },
                        { name: 'Pants', href: '#' },
                        { name: 'Denim', href: '#' },
                        { name: 'Sweaters', href: '#' },
                        { name: 'T-Shirts', href: '#' },
                        { name: 'Jackets', href: '#' },
                        { name: 'Activewear', href: '#' },
                        { name: 'Browse All', href: '#' },
                    ],
                },
                {
                    id: 'accessories',
                    name: 'Accessories',
                    items: [
                        { name: 'Watches', href: '#' },
                        { name: 'Wallets', href: '#' },
                        { name: 'Bags', href: '#' },
                        { name: 'Sunglasses', href: '#' },
                        { name: 'Hats', href: '#' },
                        { name: 'Belts', href: '#' },
                    ],
                },
                {
                    id: 'brands',
                    name: 'Brands',
                    items: [
                        { name: 'Full Nelson', href: '#' },
                        { name: 'My Way', href: '#' },
                        { name: 'Re-Arranged', href: '#' },
                        { name: 'Counterfeit', href: '#' },
                        { name: 'Significant Other', href: '#' },
                    ],
                },
            ],
        },

        {
            id: 'men',
            name: 'Premier League',

        },
        {
            id: 'men',
            name: 'Serie A',

        },
        {
            id: 'men',
            name: 'La Liga',

        },
        {
            id: 'men',
            name: 'Bundesliga',

        },
        {
            id: 'men',
            name: 'Ligue 1',

        },
        {
            id: 'men',
            name: 'MLS',

        },
        {
            id: 'men',
            name: 'More Clubs',

        },

    ],
    // pages: [
    //     { name: 'Company', href: '#' },
    //     { name: 'Stores', href: '#' },
    // ],
}

const open = ref(false)

import 'swiper/css';

const photosExamples = [
    "https://www.futbolemotion.com/imagesbanners/xxl/liquidacion_rebajas0724_ES.webp",
    "https://www.futbolemotion.com/imagesbanners/xxl/1721739168nike_fcbarcelona_home24_v2_OK.webp",
    "https://www.futbolemotion.com/imagesbanners/xxl/1721739168nike_fcbarcelona_home24_v2_OK.webp",
    "https://www.futbolemotion.com/imagesbanners/xxl/adidas_realmadrid_away24.webp"
]

</script>
<template>

    <Head title="Welcome" />

    <div class="bg-white">
        <!-- Mobile menu -->
        <TransitionRoot as="template" :show="open">
            <Dialog class="relative z-40 lg:hidden" @close="open = false">
                <TransitionChild as="template" enter="transition-opacity ease-linear duration-300"
                    enter-from="opacity-0" enter-to="opacity-100" leave="transition-opacity ease-linear duration-300"
                    leave-from="opacity-100" leave-to="opacity-0">
                    <div class="fixed inset-0 bg-black bg-opacity-25" />
                </TransitionChild>

                <div class="fixed inset-0 z-40 flex">
                    <TransitionChild as="template" enter="transition ease-in-out duration-300 transform"
                        enter-from="-translate-x-full" enter-to="translate-x-0"
                        leave="transition ease-in-out duration-300 transform" leave-from="translate-x-0"
                        leave-to="-translate-x-full">
                        <DialogPanel
                            class="relative flex flex-col w-full max-w-xs pb-12 overflow-y-auto bg-white shadow-xl">
                            <div class="flex px-4 pt-5 pb-2">
                                <button type="button"
                                    class="relative inline-flex items-center justify-center p-2 -m-2 text-gray-400 rounded-md"
                                    @click="open = false">
                                    <span class="absolute -inset-0.5" />
                                    <span class="sr-only">Close menu</span>
                                    <XMarkIcon class="w-6 h-6" aria-hidden="true" />
                                </button>
                            </div>

                            <!-- Links -->
                            <TabGroup as="div" class="mt-2">
                                <div class="border-b border-gray-200">
                                    <TabList
                                        class="flex px-4 -mb-px space-x-8 overflow-scroll [@media(max-width:1023px)]:scrollbar-hide">
                                        <Tab as="template" v-for="category in navigation.categories"
                                            :key="category.name" v-slot="{ selected }">
                                            <button
                                                :class="[selected ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-900', 'flex-1 whitespace-nowrap border-b-2 px-1 py-4 text-base font-medium']">{{
                                                    category.name }}</button>
                                        </Tab>
                                    </TabList>
                                </div>
                                <TabPanels as="template">
                                    <TabPanel v-for="category in navigation.categories" :key="category.name"
                                        class="px-4 pt-10 pb-8 space-y-10">
                                        <div class="grid grid-cols-2 gap-x-4">
                                            <div v-for="item in category.featured" :key="item.name"
                                                class="relative text-sm group">
                                                <div
                                                    class="overflow-hidden bg-gray-100 rounded-lg aspect-h-1 aspect-w-1 group-hover:opacity-75">
                                                    <img :src="item.imageSrc" :alt="item.imageAlt"
                                                        class="object-cover object-center" />
                                                </div>
                                                <a :href="item.href" class="block mt-6 font-medium text-gray-900">
                                                    <span class="absolute inset-0 z-10" aria-hidden="true" />
                                                    {{ item.name }}
                                                </a>
                                                <p aria-hidden="true" class="mt-1">Shop now</p>
                                            </div>
                                        </div>
                                        <div v-for="section in category.sections" :key="section.name">
                                            <p :id="`${category.id}-${section.id}-heading-mobile`"
                                                class="font-medium text-gray-900">{{ section.name }}</p>
                                            <ul role="list"
                                                :aria-labelledby="`${category.id}-${section.id}-heading-mobile`"
                                                class="flex flex-col mt-6 space-y-6">
                                                <li v-for="item in section.items" :key="item.name" class="flow-root">
                                                    <a :href="item.href" class="block p-2 -m-2 text-gray-500">{{
                                                        item.name }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </TabPanel>
                                </TabPanels>
                            </TabGroup>

                            <div class="px-4 py-6 space-y-6 border-t border-gray-200">
                                <div v-for="page in navigation.pages" :key="page.name" class="flow-root">
                                    <a :href="page.href" class="block p-2 -m-2 font-medium text-gray-900">{{ page.name
                                        }}</a>
                                </div>
                            </div>

                            <div class="px-4 py-6 space-y-6 border-t border-gray-200">
                                <div class="flow-root">
                                    <a href="#" class="block p-2 -m-2 font-medium text-gray-900">Sign in</a>
                                </div>
                                <div class="flow-root">
                                    <a href="#" class="block p-2 -m-2 font-medium text-gray-900">Create account</a>
                                </div>
                            </div>

                            <div class="px-4 py-6 border-t border-gray-200">
                                <a href="#" class="flex items-center p-2 -m-2">
                                    <img src="https://tailwindui.com/img/flags/flag-canada.svg" alt=""
                                        class="flex-shrink-0 block w-5 h-auto" />
                                    <span class="block ml-3 text-base font-medium text-gray-900">CAD</span>
                                    <span class="sr-only">, change currency</span>
                                </a>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </Dialog>
        </TransitionRoot>

        <header class="relative bg-white">
            <p
                class="flex items-center justify-center h-10 px-4 text-sm font-medium text-white bg-gray-950 sm:px-6 lg:px-8">
                Get free delivery on orders over $100</p>

            <nav aria-label="Top" class="px-4 mx-auto sm:px-6 lg:px-8 max-w-[108rem] py-4">
                <div class="flex items-center h-16">
                    <button type="button" class="relative p-2 text-gray-400 bg-white rounded-md lg:hidden"
                        @click="open = true">
                        <span class="absolute -inset-0.5" />
                        <span class="sr-only">Open menu</span>
                        <Bars3Icon class="w-6 h-6" aria-hidden="true" />
                    </button>

                    <!-- Logo -->
                    <div class="flex ml-4 lg:ml-0">
                        <a href="#">
                            <span class="sr-only">Your Company</span>
                            <img class="w-auto h-8"
                                src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="" />
                        </a>
                    </div>
                    <!-- imput search full size -->
                    <!-- <div class="relative hidden lg:flex lg:flex-1 lg:items-center lg:justify-end lg:space-x-6">
                        <label for="search" class="sr-only">Search</label>
                        <input id="search" type="search"
                            class="block w-50 py-2 pl-10 pr-3 text-xl text-gray-900 placeholder-gray-500 bg-gray-100 border border-transparent rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            placeholder="Search for products" />
                        <div class="absolute inset-y-0 flex items-center pl-3 pointer-events-none">
                            <MagnifyingGlassIcon class="w-5 h-5 text-gray-500" aria-hidden="true" />
                        </div>
                    </div> -->
                    <div class="hidden relative lg:flex lg:flex-1 mx-20 ">
                        <label for="search" class="sr-only">Search</label>
                        <input id="search" type="search"
                            class="block w-full py-2 pl-10 pr-3 text-xl text-gray-900 placeholder-gray-500 bg-gray-100 border border-transparent rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            placeholder="Search for products" />
                        <div class="absolute inset-y-0 flex items-center pl-3 pointer-events-none">
                            <MagnifyingGlassIcon class="w-5 h-5 text-gray-500" aria-hidden="true" />
                        </div>
                    </div>


                    <!-- Flyout menus -->
                    <!-- <PopoverGroup class="hidden lg:ml-8 lg:block lg:self-stretch ">
                        <div class="flex h-full space-x-8  ">
                            <Popover v-for="category in navigation.categories" :key="category.name" class="flex"
                                v-slot="{ open }">
                                <div class="relative flex ">
                                    <PopoverButton
                                        :class="[open ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-700 hover:text-gray-800', 'relative z-10 -mb-px flex items-center border-b-2 pt-px text-sm font-medium transition-colors duration-200 ease-out']">
                                        {{ category.name }}</PopoverButton>
                                </div>

                                <transition enter-active-class="transition duration-200 ease-out"
                                    enter-from-class="opacity-0" enter-to-class="opacity-100"
                                    leave-active-class="transition duration-150 ease-in" leave-from-class="opacity-100"
                                    leave-to-class="opacity-0">
                                    <PopoverPanel class="absolute inset-x-0 text-sm text-gray-500 top-full z-40">

                                        <div class="absolute inset-0 bg-white shadow top-1/2" aria-hidden="true" />

                                        <div class="relative bg-white">
                                            <div class="px-8 mx-auto max-w-7xl">
                                                <div class="grid grid-cols-2 py-16 gap-x-8 gap-y-10">
                                                    <div class="grid grid-cols-2 col-start-2 gap-x-8">
                                                        <div v-for="item in category.featured" :key="item.name"
                                                            class="relative text-base group sm:text-sm">
                                                            <div
                                                                class="overflow-hidden bg-gray-100 rounded-lg aspect-h-1 aspect-w-1 group-hover:opacity-75">
                                                                <img :src="item.imageSrc" :alt="item.imageAlt"
                                                                    class="object-cover object-center" />
                                                            </div>
                                                            <a :href="item.href"
                                                                class="block mt-6 font-medium text-gray-900">
                                                                <span class="absolute inset-0 z-10"
                                                                    aria-hidden="true" />
                                                                {{ item.name }}
                                                            </a>
                                                            <p aria-hidden="true" class="mt-1">Shop now</p>
                                                        </div>
                                                    </div>
                                                    <div class="grid grid-cols-3 row-start-1 text-sm gap-x-8 gap-y-10">
                                                        <div v-for="section in category.sections" :key="section.name">
                                                            <p :id="`${section.name}-heading`"
                                                                class="font-medium text-gray-900">{{ section.name }}
                                                            </p>
                                                            <ul role="list" :aria-labelledby="`${section.name}-heading`"
                                                                class="mt-6 space-y-6 sm:mt-4 sm:space-y-4">
                                                                <li v-for="item in section.items" :key="item.name"
                                                                    class="flex">
                                                                    <a :href="item.href" class="hover:text-gray-800">{{
                                                                        item.name
                                                                    }}</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </PopoverPanel>
                                </transition>
                            </Popover>

                            <a v-for="page in navigation.pages" :key="page.name" :href="page.href"
                                class="flex items-center text-sm font-medium text-gray-700 hover:text-gray-800">{{
                                    page.name }}</a>
                        </div>
                    </PopoverGroup> -->

                    <div class="flex items-center ml-auto">
                        <!-- <div class="hidden lg:flex lg:flex-1 lg:items-center lg:justify-end lg:space-x-6">
                                <a href="#" class="text-sm font-medium text-gray-700 hover:text-gray-800">Sign in</a>
                                <span class="w-px h-6 bg-gray-200" aria-hidden="true" />
                                <a href="#" class="text-sm font-medium text-gray-700 hover:text-gray-800">Create
                                    account</a>
                            </div> -->
                        <!-- <div class="hidden lg:ml-8 lg:flex">
                            <a href="#" class="flex items-center text-gray-700 hover:text-gray-800">
                                <img src="https://tailwindui.com/img/flags/flag-canada.svg" alt=""
                                    class="flex-shrink-0 block w-5 h-auto" />
                                <span class="block ml-3 text-sm font-medium">CAD</span>
                                <span class="sr-only">, change currency</span>
                            </a>
                        </div> -->

                        <!-- Search -->
                        <!-- <div class="flex lg:ml-6">
                                <a href="#" class="p-2 text-gray-400 hover:text-gray-500">
                                    <span class="sr-only">Search</span>
                                    <MagnifyingGlassIcon class="w-6 h-6" aria-hidden="true" />
                                </a>
                            </div> -->
                        <!-- Account -->
                        <div class="flow-root ml-4 lg:ml-6">

                            <button type="button" class="btn btn-link text-secondary text-center text-decoration-none">
                                <span class="position-relative d-block">
                                    <UserIcon class="flex-shrink-0 w-9 h-9 text-gray-400 group-hover:text-gray-500"
                                        aria-hidden="true" />
                                </span>
                                <small class="mt-2 pt-1 text-secondary lh-1 d-none d-lg-block">Sign in</small>
                            </button>

                            <!-- <a href="#" class="flex items-center p-2 -m-2 group">
                                <UserIcon class="flex-shrink-0 w-9 h-9 text-gray-400 group-hover:text-gray-500"
                                    aria-hidden="true" />

                                <span class="sr-only">items in cart, view bag</span>
                            </a> -->
                        </div>
                        <!-- Cart -->
                        <div class="flow-root ml-4 lg:ml-6">

                            <button type="button" class="btn btn-link text-secondary text-center text-decoration-none">
                                <span class="position-relative d-block">
                                    <ShoppingBagIcon
                                        class="flex-shrink-0 w-9 h-9 text-gray-400 group-hover:text-gray-500"
                                        aria-hidden="true" />
                                </span>
                                <small class="mt-2 pt-1 text-secondary lh-1 d-none d-lg-block">Cart</small>
                            </button>

                            <!-- <a href="#" class="flex items-center p-2 -m-2 group">
                                <ShoppingBagIcon class="flex-shrink-0 w-9 h-9 text-gray-400 group-hover:text-gray-500"
                                    aria-hidden="true" />
                                <span class="sr-only">items in cart, view bag</span>
                            </a> -->
                        </div>

                    </div>
                </div>
            </nav>
            <!-- SEARCH -->
            <nav aria-label="Top" class="px-4 mx-auto sm:px-6 lg:px-8 max-w-[108rem] ">

                <div class="border-b border-gray-200">
                    <div class="items-center mb-4">

                        <!-- <div class="hidden lg:flex lg:flex-1 lg:items-center lg:justify-end lg:space-x-6">
                                <a href="#" class="text-sm font-medium text-gray-700 hover:text-gray-800">Sign in</a>
                                <span class="w-px h-6 bg-gray-200" aria-hidden="true" />
                                <a href="#" class="text-sm font-medium text-gray-700 hover:text-gray-800">Create
                                    account</a>
                            </div> -->

                        <div class="hidden  lg:flex">
                            <!-- Flyout menus -->
                            <PopoverGroup class="hidden  lg:block lg:self-stretch ">
                                <div class="flex h-full space-x-8  ">
                                    <Popover v-for="category in navigation.categories" :key="category.name" class="flex"
                                        v-slot="{ open }">
                                        <div class="relative flex ">
                                            <PopoverButton
                                                :class="[open ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-700 hover:text-gray-800', 'relative z-10 -mb-px flex items-center border-b-2 pt-px text-lg font-semibold transition-colors duration-200 ease-out']">
                                                {{ category.name }}</PopoverButton>
                                        </div>

                                        <transition enter-active-class="transition duration-200 ease-out"
                                            enter-from-class="opacity-0" enter-to-class="opacity-100"
                                            leave-active-class="transition duration-150 ease-in"
                                            leave-from-class="opacity-100" leave-to-class="opacity-0">
                                            <PopoverPanel
                                                class="absolute inset-x-0 text-sm text-gray-500 top-full z-40">

                                                <div class="absolute inset-0 bg-white shadow top-1/2"
                                                    aria-hidden="true" />

                                                <div class="relative bg-white">
                                                    <div class="px-8 mx-auto max-w-7xl">
                                                        <div class="grid grid-cols-2 py-16 gap-x-8 gap-y-10">
                                                            <div class="grid grid-cols-2 col-start-2 gap-x-8">
                                                                <div v-for="item in category.featured" :key="item.name"
                                                                    class="relative text-base group sm:text-sm">
                                                                    <div
                                                                        class="overflow-hidden bg-gray-100 rounded-lg aspect-h-1 aspect-w-1 group-hover:opacity-75">
                                                                        <img :src="item.imageSrc" :alt="item.imageAlt"
                                                                            class="object-cover object-center" />
                                                                    </div>
                                                                    <a :href="item.href"
                                                                        class="block mt-6 font-medium text-gray-900">
                                                                        <span class="absolute inset-0 z-10"
                                                                            aria-hidden="true" />
                                                                        {{ item.name }}
                                                                    </a>
                                                                    <p aria-hidden="true" class="mt-1">Shop now</p>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="grid grid-cols-3 row-start-1 text-sm gap-x-8 gap-y-10">
                                                                <div v-for="section in category.sections"
                                                                    :key="section.name">
                                                                    <p :id="`${section.name}-heading`"
                                                                        class="font-medium text-gray-900">{{
                                                                            section.name }}
                                                                    </p>
                                                                    <ul role="list"
                                                                        :aria-labelledby="`${section.name}-heading`"
                                                                        class="mt-6 space-y-6 sm:mt-4 sm:space-y-4">
                                                                        <li v-for="item in section.items"
                                                                            :key="item.name" class="flex">
                                                                            <a :href="item.href"
                                                                                class="hover:text-gray-800">{{
                                                                                    item.name
                                                                                }}</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </PopoverPanel>
                                        </transition>
                                    </Popover>

                                    <a v-for="page in navigation.pages" :key="page.name" :href="page.href"
                                        class="flex items-center text-sm font-medium text-gray-700 hover:text-gray-800">{{
                                            page.name }}</a>
                                </div>
                            </PopoverGroup>
                        </div>
                        <!-- Search -->
                        <div class="relative lg:hidden ">
                            <label for="search" class="sr-only">Search</label>
                            <input id="search" type="search"
                                class="block w-full py-2 pl-10 pr-3 text-xl text-gray-900 placeholder-gray-500 bg-gray-100 border border-transparent rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                placeholder="Search for products" />
                            <div class="absolute inset-y-0 flex items-center pl-3 pointer-events-none">
                                <MagnifyingGlassIcon class="w-5 h-5 text-gray-500" aria-hidden="true" />
                            </div>
                        </div>

                    </div>
                </div>
            </nav>
        </header>
    </div>

    <Swiper>
        <SwiperSlide v-for="photo in photosExamples" :key="photo">
            <img :src="photo" alt="photo" class="w-full h-96 object-cover " />
        </SwiperSlide>
    </Swiper>


</template>
