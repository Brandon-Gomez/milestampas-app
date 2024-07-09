import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import PrimeVue from 'primevue/config';
import Lara from '@primevue/themes/aura';
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

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(PrimeVue,{
                ripple: true,
                // unstyled: true,
                theme: {
                    preset: Lara,
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
            .directive('ripple', Ripple)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
