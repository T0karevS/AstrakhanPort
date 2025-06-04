import {createRouter, createWebHistory } from 'vue-router'
import Home from '@/pages/App.vue'
import Services from '@/pages/Services.vue'

const routes = [
    {
        path: '/', component: Home
    },
    {
        path: '/services', component: Services
    },
]
const router = createRouter({
    history: createWebHistory(),
    routes
})
export default router