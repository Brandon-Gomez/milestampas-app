import './bootstrap';
import '../css/app.css';
import 'primeicons/primeicons.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import PrimeVue from 'primevue/config';
import Aura from '@primevue/themes/aura';
import Button from "primevue/button";
import MultiSelect from 'primevue/multiselect';
import InputText from 'primevue/inputtext';
import Textarea from 'primevue/textarea';
import Select from 'primevue/select';
import FileUpload from 'primevue/fileupload';
import Tab from 'primevue/tab';
import Tabs from 'primevue/tabs';
import TabPanel from 'primevue/tabpanel';
import TabPanels from 'primevue/tabpanels';
import TabList from 'primevue/tablist';
import Ripple from 'primevue/ripple';
import InputNumber from 'primevue/inputnumber';
import Toast from 'primevue/toast';
import ToastService from 'primevue/toastservice';
import Card from 'primevue/card';
import Carousel from 'primevue/carousel';
import IconField from 'primevue/iconfield';
import InputIcon from 'primevue/inputicon';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Row from 'primevue/row';
import Badge from 'primevue/badge';
import { Swiper, SwiperSlide } from 'swiper/vue';
import { definePreset } from '@primevue/themes';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';
const CustomPreset = definePreset(Aura, {
    semantic: {
        primary: {
            50: '{gray.50}',
            100: '{gray.100}',
            200: '{gray.200}',
            300: '{gray.300}',
            400: '{gray.400}',
            500: '{gray.500}',
            600: '{gray.600}',
            700: '{gray.700}',
            800: '{gray.800}',
            900: '{gray.900}',
            950: '{gray.950}'
        }
    }
});
createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(ToastService)
            .use(PrimeVue,{
                ripple: true,
                // unstyled: true,
                theme: {
                    preset: CustomPreset,
                    options: {
                        darkModeSelector: '.my-app-dark',
                    }
                },
            })
            .component('Button', Button)
            .component('MultiSelect', MultiSelect)
            .component('InputText', InputText)
            .component('Textarea', Textarea)
            .component('Select', Select)
            .component('FileUpload', FileUpload)
            .component('Tab', Tab)
            .component('Tabs', Tabs)
            .component('TabPanel', TabPanel)
            .component('TabPanels', TabPanels)
            .component('TabList', TabList)
            .component('InputNumber', InputNumber)
            .component('Toast', Toast)
            .component('Card', Card)
            .component('Carousel', Carousel)
            .component('IconField', IconField)
            .component('InputIcon', InputIcon)
            .component('DataTable', DataTable)
            .component('Column', Column)
            .component('Row', Row)
            .component('Swiper', Swiper)
            .component('SwiperSlide', SwiperSlide)
            .component('Badge', Badge)

            .directive('ripple', Ripple)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
