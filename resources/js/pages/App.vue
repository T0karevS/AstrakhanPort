
<script setup>
import { onMounted } from 'vue'
onMounted(() => {
    document.title = 'Главная';
})
import '../../css/mainpage.css'
import Header from '@/components/header.vue'
import MainPage from '@/components/mainpage.vue'
import MainPageContainer from '@/components/maincontainer.vue'
import Contacts from '@/components/Contacts.vue'
import Footer from '@/components/Footer.vue'
import PopUpButton from '@/components/PopUpButton.vue'
import { Head, usePage } from '@inertiajs/vue3'
import { showModal, modalProps, closeModal, openModal } from '@/modal.js'
</script>
<template>
    <PopUpButton v-if="showModal" @close="closeModal" :props="modalProps" />
    <Head>
        <title>Главная</title>
    </Head>
    <Header />
    <MainPage />
    <MainPageContainer />
    <Contacts />
    <Footer />
    
    <router-view />
</template>