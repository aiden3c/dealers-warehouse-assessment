import './bootstrap';
import { createApp } from 'vue';
import Navbar from './components/Navbar.vue';
import CustomerCard from './components/CustomerCard.vue';


const app = createApp({});

app.component('navbar', Navbar);
app.component('customer-card', CustomerCard);

app.mount('#app');
