
<script setup>
import '../../css/services.css'
import Header from '@/components/header.vue'
import Breadcrumbs from '@/components/BreadcrumbsCustom.vue'
import MainPageContainer from '@/components/maincontainer.vue'
import Footer from '@/components/footer.vue'
</script>
<template>
    <Header />
    <Breadcrumbs />
    <MainPageContainer />
    <Footer />
    <router-view />
</template>