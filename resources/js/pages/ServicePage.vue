<template>
    <Header />
    <PopUpButton v-if="showModal" @close="closeModal" :props="modalProps" />
    <BreadCrumbsCustom />
    <ServiceComponent />
    <Footer />
</template>
<script setup>
import Header from '@/components/header.vue';
import PopUpButton from '@/components/PopUpButton.vue';
import BreadCrumbsCustom from '@/components/BreadCrumbsCustom.vue';
import ServiceComponent from '@/components/ServiceComponent.vue';
import Footer from '@/components/Footer.vue';
import { showModal, modalProps, closeModal, openModal } from '@/modal.js'
</script>
<style>
    .breadcrumbs, .breadcrumbs li{
        color: white !important;
        
    }
    .breadcrumbs svg{
        fill: white !important;
        stroke: white !important;
    }
    .breadcrumbs{
        margin: 400px 0 100px;
    }
</style>