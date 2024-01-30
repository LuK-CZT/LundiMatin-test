import { createRouter, createWebHistory  } from 'vue-router';
import MainPageVue from '../views/MainPage.vue';
import InfoClient from '../views/InfoClient.vue';
import EditClientVue from '../views/EditClient.vue';

const routes = [
	{ path: '/', component: MainPageVue },
	{ path: '/client/:id', component: InfoClient },
	{ path: '/client/:id/edit', component: EditClientVue },
];

const router = createRouter({
	history: createWebHistory (),
	routes : routes
});

export default router;
