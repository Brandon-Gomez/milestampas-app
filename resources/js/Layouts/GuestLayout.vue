<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { Navigation, Pagination, Scrollbar, EffectFade, Autoplay } from 'swiper/modules';
import { Swiper, SwiperSlide } from 'swiper/vue';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/scrollbar';
import 'swiper/css/effect-fade';
import axios from 'axios';
import { ref, onBeforeMount } from 'vue';

import {
    Dialog,
    DialogPanel,
    Popover,
    PopoverButton,
    PopoverGroup,
    PopoverPanel,
    TransitionChild,
    TransitionRoot,
} from '@headlessui/vue';
import { Bars3Icon, MagnifyingGlassIcon, ShoppingBagIcon, XMarkIcon, UserIcon } from '@heroicons/vue/24/outline';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
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

</script>
<template>

    <nav>
        <div class="bg-white">
            <TransitionRoot as="template" :show="open">
                <Dialog class="relative z-40 lg:hidden" @close="open = false">
                    <TransitionChild as="template" enter="transition-opacity ease-linear duration-300"
                        enter-from="opacity-0" enter-to="opacity-100"
                        leave="transition-opacity ease-linear duration-300" leave-from="opacity-100"
                        leave-to="opacity-0">
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
                                <!-- <TabGroup as="div" class="mt-2">
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
                                                    <li v-for="item in section.items" :key="item.name"
                                                        class="flow-root">
                                                        <a :href="item.href" class="block p-2 -m-2 text-gray-500">{{
                                                            item.name }}</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </TabPanel>
                                    </TabPanels>
                                </TabGroup> -->

                                <div class="px-4 py-6 space-y-6 border-t border-gray-200">
                                    <div v-for="page in navigation.pages" :key="page.name" class="flow-root">
                                        <a :href="page.href" class="block p-2 -m-2 font-medium text-gray-900">{{
                                            page.name
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
                    class="flex items-center justify-center h-10 px-4 text-sm font-medium text-white bg-[#222325] sm:px-6 lg:px-8">
                    Get free delivery on orders over $100</p>

                <nav aria-label="Top" class="px-4 mx-auto sm:px-6 lg:px-8 max-w-[107rem] py-4">
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
                                <!-- <img class="w-auto h-8"
                                    src="" alt="" /> -->
                            </a>
                        </div>
                        <!-- imput search full size -->
                        <!-- <div class="relative hidden lg:flex lg:flex-1 lg:items-center lg:justify-end lg:space-x-6">
                        <label for="search" class="sr-only">Search</label>
                        <input id="search" type="search"
                            class="block py-2 pl-10 pr-3 text-xl text-gray-900 placeholder-gray-500 bg-gray-100 border border-transparent rounded-full w-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            placeholder="Search for products" />
                        <div class="absolute inset-y-0 flex items-center pl-3 pointer-events-none">
                            <MagnifyingGlassIcon class="w-5 h-5 text-gray-500" aria-hidden="true" />
                        </div>
                    </div> -->
                        <div class="relative hidden mx-20 lg:flex lg:flex-1">
                            <label for="search-xl" class="sr-only">Search</label>
                            <input id="search-xl" type="search"
                                class="block w-full h-12 py-2 pl-10 pr-3 text-xl text-gray-900 placeholder-gray-500 bg-gray-100 border border-transparent rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                placeholder="Search for products" />
                            <div class="absolute inset-y-0 flex items-center pl-3 pointer-events-none">
                                <MagnifyingGlassIcon class="w-5 h-5 text-gray-500" aria-hidden="true" />
                            </div>
                        </div>

                        <!-- Flyout menus -->
                        <!-- <PopoverGroup class="hidden lg:ml-8 lg:block lg:self-stretch ">
                        <div class="flex h-full space-x-8 ">
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
                                    <PopoverPanel class="absolute inset-x-0 z-40 text-sm text-gray-500 top-full">

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

                                <button type="button"
                                    class="text-center btn btn-link text-secondary text-decoration-none">
                                    <span class="position-relative d-block">
                                        <UserIcon class="flex-shrink-0 text-gray-400 w-7 h-7 group-hover:text-gray-500"
                                            aria-hidden="true" />
                                    </span>
                                    <small class="pt-1 mt-2 text-secondary lh-1 d-none d-lg-block">Sign in</small>
                                </button>

                                <!-- <a href="#" class="flex items-center p-2 -m-2 group">
                                <UserIcon class="flex-shrink-0 text-gray-400 w-9 h-9 group-hover:text-gray-500"
                                    aria-hidden="true" />

                                <span class="sr-only">items in cart, view bag</span>
                            </a> -->
                            </div>
                            <!-- Cart -->
                            <div class="flow-root ml-4 lg:ml-6">

                                <button type="button"
                                    class="text-center btn btn-link text-secondary text-decoration-none">
                                    <span class="position-relative d-block">
                                        <ShoppingBagIcon
                                            class="flex-shrink-0 text-gray-400 w-7 h-7 group-hover:text-gray-500"
                                            aria-hidden="true" />
                                    </span>
                                    <small class="pt-1 mt-2 text-secondary lh-1 d-none d-lg-block">Cart</small>
                                </button>

                                <!-- <a href="#" class="flex items-center p-2 -m-2 group">
                                <ShoppingBagIcon class="flex-shrink-0 text-gray-400 w-9 h-9 group-hover:text-gray-500"
                                    aria-hidden="true" />
                                <span class="sr-only">items in cart, view bag</span>
                            </a> -->
                            </div>

                        </div>
                    </div>
                </nav>
                <!-- SEARCH -->
                <nav aria-label="Top" class="px-4 mx-auto sm:px-6 lg:px-8 max-w-[107rem] ">

                    <div class="items-center mb-4">

                        <!-- <div class="hidden lg:flex lg:flex-1 lg:items-center lg:justify-end lg:space-x-6">
                                <a href="#" class="text-sm font-medium text-gray-700 hover:text-gray-800">Sign in</a>
                                <span class="w-px h-6 bg-gray-200" aria-hidden="true" />
                                <a href="#" class="text-sm font-medium text-gray-700 hover:text-gray-800">Create
                                    account</a>
                            </div> -->

                        <div class="hidden lg:flex">
                            <!-- Flyout menus -->
                            <PopoverGroup class="hidden lg:block lg:self-stretch ">
                                <div class="flex h-full space-x-8 ">
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
                                                class="absolute inset-x-0 z-40 text-sm text-gray-500 top-full">

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
                </nav>
            </header>
        </div>
    </nav>

    <slot/>

    <footer class="relative z-10 pt-20 pb-10 lg:pt-[120px] lg:pb-20 px-4 bg-[#222325]">
        <div class="container mx-auto">
            <div class="flex flex-wrap -mx-4">
                <div class="w-full px-4 sm:w-2/3 lg:w-3/12">
                    <div class="w-full mb-10">
                        <a href="javascript:void(0)" class="mb-6 inline-block max-w-[160px]">
                            <img src="https://cdn.tailgrids.com/2.0/image/assets/images/logo/logo.svg" alt="logo"
                                class="max-w-full " />
                            <img src="https://cdn.tailgrids.com/2.0/image/assets/images/logo/logo-white.svg" alt="logo"
                                class="hidden max-w-full " />
                        </a>
                        <p class="text-white text-body-color mb-7">
                            Sed ut perspiciatis undmnis is iste natus error sit amet
                            voluptatem totam rem aperiam.
                        </p>
                        <p class="flex items-center text-sm font-medium text-white ">
                            <span class="mr-3 text-primary">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_941_15626)">
                                        <path
                                            d="M15.1875 19.4688C14.3438 19.4688 13.375 19.25 12.3125 18.8438C10.1875 18 7.84377 16.375 5.75002 14.2813C3.65627 12.1875 2.03127 9.84377 1.18752 7.68752C0.250019 5.37502 0.343769 3.46877 1.43752 2.40627C1.46877 2.37502 1.53127 2.34377 1.56252 2.31252L4.18752 0.750025C4.84377 0.375025 5.68752 0.562525 6.12502 1.18752L7.96877 3.93753C8.40627 4.59378 8.21877 5.46877 7.59377 5.90627L6.46877 6.68752C7.28127 8.00002 9.59377 11.2188 13.2813 13.5313L13.9688 12.5313C14.5 11.7813 15.3438 11.5625 16.0313 12.0313L18.7813 13.875C19.4063 14.3125 19.5938 15.1563 19.2188 15.8125L17.6563 18.4375C17.625 18.5 17.5938 18.5313 17.5625 18.5625C17 19.1563 16.1875 19.4688 15.1875 19.4688ZM2.37502 3.46878C1.78127 4.12503 1.81252 5.46877 2.50002 7.18752C3.28127 9.15627 4.78127 11.3125 6.75002 13.2813C8.68752 15.2188 10.875 16.7188 12.8125 17.5C14.5 18.1875 15.8438 18.2188 16.5313 17.625L18.0313 15.0625C18.0313 15.0313 18.0313 15.0313 18.0313 15L15.2813 13.1563C15.2813 13.1563 15.2188 13.1875 15.1563 13.2813L14.4688 14.2813C14.0313 14.9063 13.1875 15.0938 12.5625 14.6875C8.62502 12.25 6.18752 8.84377 5.31252 7.46877C4.90627 6.81252 5.06252 5.96878 5.68752 5.53128L6.81252 4.75002V4.71878L4.96877 1.96877C4.96877 1.93752 4.93752 1.93752 4.90627 1.96877L2.37502 3.46878Z"
                                            fill="currentColor" />
                                        <path
                                            d="M18.3125 8.90633C17.9375 8.90633 17.6563 8.62508 17.625 8.25008C17.375 5.09383 14.7813 2.56258 11.5938 2.34383C11.2188 2.31258 10.9063 2.00008 10.9375 1.59383C10.9688 1.21883 11.2813 0.906333 11.6875 0.937583C15.5625 1.18758 18.7188 4.25008 19.0313 8.12508C19.0625 8.50008 18.7813 8.84383 18.375 8.87508C18.375 8.90633 18.3438 8.90633 18.3125 8.90633Z"
                                            fill="currentColor" />
                                        <path
                                            d="M15.2187 9.18755C14.875 9.18755 14.5625 8.93755 14.5312 8.56255C14.3437 6.87505 13.0312 5.56255 11.3437 5.3438C10.9687 5.31255 10.6875 4.93755 10.7187 4.56255C10.75 4.18755 11.125 3.9063 11.5 3.93755C13.8437 4.2188 15.6562 6.0313 15.9375 8.37505C15.9687 8.75005 15.7187 9.0938 15.3125 9.1563C15.25 9.18755 15.2187 9.18755 15.2187 9.18755Z"
                                            fill="currentColor" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_941_15626">
                                            <rect width="20" height="20" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </span>
                            <span>+012 (345) 678 99</span>
                        </p>
                    </div>
                </div>
                <div class="w-full px-4 sm:w-1/2 lg:w-2/12">
                    <div class="w-full mb-10">
                        <h4 class="text-lg font-semibold text-white mb-9">
                            Resources
                        </h4>
                        <ul class="space-y-3">
                            <li>
                                <a href="javascript:void(0)"
                                    class="inline-block leading-loose text-white hover:text-primary ">
                                    SaaS Development
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"
                                    class="inline-block leading-loose text-white hover:text-primary ">
                                    Our Products
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"
                                    class="inline-block leading-loose text-white hover:text-primary ">
                                    User Flow
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"
                                    class="inline-block leading-loose text-white hover:text-primary ">
                                    User Strategy
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="w-full px-4 sm:w-1/2 lg:w-2/12">
                    <div class="w-full mb-10">
                        <h4 class="text-lg font-semibold text-white mb-9">
                            Company
                        </h4>
                        <ul class="space-y-3">
                            <li>
                                <a href="javascript:void(0)"
                                    class="inline-block leading-loose text-white hover:text-primary ">
                                    About TailGrids
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"
                                    class="inline-block leading-loose text-white hover:text-primary ">
                                    Contact & Support
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"
                                    class="inline-block leading-loose text-white hover:text-primary ">
                                    Success History
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"
                                    class="inline-block leading-loose text-white hover:text-primary ">
                                    Setting & Privacy
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="w-full px-4 sm:w-1/2 lg:w-2/12">
                    <div class="w-full mb-10">
                        <h4 class="text-lg font-semibold text-white mb-9">
                            Quick Links
                        </h4>
                        <ul class="space-y-3">
                            <li>
                                <a href="javascript:void(0)"
                                    class="inline-block leading-loose text-white hover:text-primary ">
                                    Premium Support
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"
                                    class="inline-block leading-loose text-white hover:text-primary ">
                                    Our Services
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"
                                    class="inline-block leading-loose text-white hover:text-primary ">
                                    Know Our Team
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"
                                    class="inline-block leading-loose text-white hover:text-primary ">
                                    Download App
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="w-full px-4 sm:w-1/2 lg:w-3/12">
                    <div class="w-full mb-10">
                        <h4 class="text-lg font-semibold text-white mb-9">
                            Follow Us On
                        </h4>
                        <div class="flex items-center mb-6">
                            <a href="javascript:void(0)"
                                class="flex items-center justify-center w-8 h-8 mr-3 text-white border rounded-full hover:border-primary hover:bg-primary border-stroke hover:text-white sm:mr-4 lg:mr-3 xl:mr-4">
                                <svg width="8" height="16" viewBox="0 0 8 16" class="fill-current">
                                    <path
                                        d="M7.43902 6.4H6.19918H5.75639V5.88387V4.28387V3.76774H6.19918H7.12906C7.3726 3.76774 7.57186 3.56129 7.57186 3.25161V0.516129C7.57186 0.232258 7.39474 0 7.12906 0H5.51285C3.76379 0 2.54609 1.44516 2.54609 3.5871V5.83226V6.34839H2.10329H0.597778C0.287819 6.34839 0 6.63226 0 7.04516V8.90323C0 9.26452 0.243539 9.6 0.597778 9.6H2.05902H2.50181V10.1161V15.3032C2.50181 15.6645 2.74535 16 3.09959 16H5.18075C5.31359 16 5.42429 15.9226 5.51285 15.8194C5.60141 15.7161 5.66783 15.5355 5.66783 15.3806V10.1419V9.62581H6.13276H7.12906C7.41688 9.62581 7.63828 9.41935 7.68256 9.10968V9.08387V9.05806L7.99252 7.27742C8.01466 7.09677 7.99252 6.89032 7.85968 6.68387C7.8154 6.55484 7.61614 6.42581 7.43902 6.4Z" />
                                </svg>
                            </a>
                            <a href="javascript:void(0)"
                                class="flex items-center justify-center w-8 h-8 mr-3 text-white border rounded-full hover:border-primary hover:bg-primary border-stroke hover:text-white sm:mr-4 lg:mr-3 xl:mr-4">
                                <svg width="16" height="12" viewBox="0 0 16 12" class="fill-current">
                                    <path
                                        d="M14.2194 2.06654L15.2 0.939335C15.4839 0.634051 15.5613 0.399217 15.5871 0.2818C14.8129 0.704501 14.0903 0.845401 13.6258 0.845401H13.4452L13.3419 0.751468C12.7226 0.258317 11.9484 0 11.1226 0C9.31613 0 7.89677 1.36204 7.89677 2.93542C7.89677 3.02935 7.89677 3.17025 7.92258 3.26419L8 3.73386L7.45806 3.71037C4.15484 3.61644 1.44516 1.03327 1.00645 0.587084C0.283871 1.76125 0.696774 2.88845 1.13548 3.59296L2.0129 4.90802L0.619355 4.20352C0.645161 5.18982 1.05806 5.96477 1.85806 6.52838L2.55484 6.99804L1.85806 7.25636C2.29677 8.45401 3.27742 8.94716 4 9.13503L4.95484 9.36986L4.05161 9.93346C2.60645 10.8728 0.8 10.8024 0 10.7319C1.62581 11.7652 3.56129 12 4.90323 12C5.90968 12 6.65806 11.9061 6.83871 11.8356C14.0645 10.2857 14.4 4.41487 14.4 3.2407V3.07632L14.5548 2.98239C15.4323 2.23092 15.7935 1.8317 16 1.59687C15.9226 1.62035 15.8194 1.66732 15.7161 1.6908L14.2194 2.06654Z" />
                                </svg>
                            </a>
                            <a href="javascript:void(0)"
                                class="flex items-center justify-center w-8 h-8 mr-3 text-white border rounded-full hover:border-primary hover:bg-primary border-stroke hover:text-white sm:mr-4 lg:mr-3 xl:mr-4">
                                <svg width="16" height="12" viewBox="0 0 16 12" class="fill-current">
                                    <path
                                        d="M15.6645 1.88018C15.4839 1.13364 14.9419 0.552995 14.2452 0.359447C13.0065 6.59222e-08 8 0 8 0C8 0 2.99355 6.59222e-08 1.75484 0.359447C1.05806 0.552995 0.516129 1.13364 0.335484 1.88018C0 3.23502 0 6 0 6C0 6 0 8.79263 0.335484 10.1198C0.516129 10.8664 1.05806 11.447 1.75484 11.6406C2.99355 12 8 12 8 12C8 12 13.0065 12 14.2452 11.6406C14.9419 11.447 15.4839 10.8664 15.6645 10.1198C16 8.79263 16 6 16 6C16 6 16 3.23502 15.6645 1.88018ZM6.4 8.57143V3.42857L10.5548 6L6.4 8.57143Z" />
                                </svg>
                            </a>
                            <a href="javascript:void(0)"
                                class="flex items-center justify-center w-8 h-8 mr-3 text-white border rounded-full hover:border-primary hover:bg-primary border-stroke hover:text-white sm:mr-4 lg:mr-3 xl:mr-4">
                                <svg width="14" height="14" viewBox="0 0 14 14" class="fill-current">
                                    <path
                                        d="M13.0214 0H1.02084C0.453707 0 0 0.451613 0 1.01613V12.9839C0 13.5258 0.453707 14 1.02084 14H12.976C13.5432 14 13.9969 13.5484 13.9969 12.9839V0.993548C14.0422 0.451613 13.5885 0 13.0214 0ZM4.15142 11.9H2.08705V5.23871H4.15142V11.9ZM3.10789 4.3129C2.42733 4.3129 1.90557 3.77097 1.90557 3.11613C1.90557 2.46129 2.45002 1.91935 3.10789 1.91935C3.76577 1.91935 4.31022 2.46129 4.31022 3.11613C4.31022 3.77097 3.81114 4.3129 3.10789 4.3129ZM11.9779 11.9H9.9135V8.67097C9.9135 7.90323 9.89082 6.8871 8.82461 6.8871C7.73571 6.8871 7.57691 7.74516 7.57691 8.60323V11.9H5.51254V5.23871H7.53154V6.16452H7.55423C7.84914 5.62258 8.50701 5.08065 9.52785 5.08065C11.6376 5.08065 12.0232 6.43548 12.0232 8.2871V11.9H11.9779Z" />
                                </svg>
                            </a>
                        </div>
                        <p class="text-white">
                            &copy; 2025 TailGrids
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div>
        </div>
    </footer>
    <!-- ====== Footer Section End -->

</template>
