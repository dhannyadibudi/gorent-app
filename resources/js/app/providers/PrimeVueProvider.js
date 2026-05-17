import PrimeVue from 'primevue/config'
import Aura from '@primevue/themes/aura'

export function setupPrimeVue(app) {
    app.use(PrimeVue, {
        theme: {
            preset: Aura,
        },
    })
}