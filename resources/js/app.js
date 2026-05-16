import '../css/app.css'
import './bootstrap'

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { ZiggyVue } from '../../vendor/tightenco/ziggy'

/*
|--------------------------------------------------------------------------
| PrimeVue
|--------------------------------------------------------------------------
*/

import PrimeVue from 'primevue/config'
import Aura from '@primeuix/themes/aura'

/*
|--------------------------------------------------------------------------
| PrimeVue Components
|--------------------------------------------------------------------------
*/

import DataTable from 'primevue/datatable'
import Column from 'primevue/column'
import Tag from 'primevue/tag'
import Button from 'primevue/button'
import Dropdown from 'primevue/dropdown'
import Card from 'primevue/card'

/*
|--------------------------------------------------------------------------
| PrimeVue Services
|--------------------------------------------------------------------------
*/

import ToastService from 'primevue/toastservice'
import ConfirmationService from 'primevue/confirmationservice'

/*
|--------------------------------------------------------------------------
| Prime Icons
|--------------------------------------------------------------------------
*/

import 'primeicons/primeicons.css'

const appName = import.meta.env.VITE_APP_NAME || 'Laravel'

createInertiaApp({
    title: (title) => `${title} - ${appName}`,

    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue'),
        ),

    setup({ el, App, props, plugin }) {

        const app = createApp({
            render: () => h(App, props),
        })

        /*
        |--------------------------------------------------------------------------
        | Plugins
        |--------------------------------------------------------------------------
        */

        app.use(plugin)
        app.use(ZiggyVue)

        app.use(PrimeVue, {
            theme: {
                preset: Aura,
            },
        })

        app.use(ToastService)
        app.use(ConfirmationService)

        /*
        |--------------------------------------------------------------------------
        | Global Components
        |--------------------------------------------------------------------------
        */

        app.component('DataTable', DataTable)
        app.component('Column', Column)
        app.component('Tag', Tag)
        app.component('Button', Button)
        app.component('Dropdown', Dropdown)
        app.component('Card', Card)

        /*
        |--------------------------------------------------------------------------
        | Mount
        |--------------------------------------------------------------------------
        */

        app.mount(el)

        return app
    },

    progress: {
        color: '#4B5563',
    },
})