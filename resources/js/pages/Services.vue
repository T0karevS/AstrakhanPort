
<script setup>
import Header from '@/components/header.vue'
import Footer from '@/components/footer.vue'
import MainPageContainer from '@/components/maincontainer.vue'
</script>
<template>
    <Header />
    <MainPageContainer />
    <Footer />
    <router-view />
</template>