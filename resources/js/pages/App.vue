
<script setup>
import '../../css/mainpage.css'
import Header from '@/components/header.vue'
import MainPage from '@/components/mainpage.vue'
import MainPageContainer from '@/components/maincontainer.vue'
import Contacts from '@/components/Contacts.vue'
import Footer from '@/components/Footer.vue'
import { onMounted } from 'vue'
onMounted(() => {
    document.title = 'Главная';
})
</script>
<template>
    <Header />
    <MainPage />
    <MainPageContainer />
    <Contacts />
    <Footer />
    <router-view />
</template>