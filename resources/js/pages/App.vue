
<script setup>
import Header from '@/components/header.vue'
import MainPage from '@/components/mainpage.vue'
import MainPageContainer from '@/components/maincontainer.vue'
import Contacts from '@/components/Contacts.vue'
import Footer from '@/components/Footer.vue'
</script>
<template>
    <Header />
    <MainPage />
    <MainPageContainer />
    <Contacts />
    <Footer />
    <router-view />
</template>