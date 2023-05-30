import './bootstrap';
import { createApp } from 'vue';

const app = createApp({});


import Index from './components/Index.vue'
import RoomDetails from './components/RoomDetails.vue'
app.component('v-index', Index)
app.component('v-room', RoomDetails)


app.mount('#app');
