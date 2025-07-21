<template>
    <Header />
    <Breadcrumbs />
    <NewsPageComponent />
    <Footer />
</template>
<script setup>
import '../../css/style.css'
import Header from '@/components/header.vue'
import Breadcrumbs from '@/components/BreadCrumbsCustom.vue'
import NewsPageComponent from '@/components/NewsPageComponent.vue'
import Footer from '@/components/Footer.vue'
</script>
