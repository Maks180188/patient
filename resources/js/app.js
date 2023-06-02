import './bootstrap';
import { createApp } from 'vue'
import PatientComponent from './components/PatientComponent.vue'
import WaveUI from 'wave-ui'
import 'wave-ui/dist/wave-ui.css'

const app = createApp({});

app.use(WaveUI, {
})

app.component('patient-component', PatientComponent)
    .mount('#app');


