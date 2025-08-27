
<script setup>
import Header from '@/components/header.vue'
import Breadcrumbs from '@/components/BreadcrumbsCustom.vue'
import ContactsPage from '@/components/ContactsPage.vue'
import Footer from '@/components/footer.vue'
import { showModal, modalProps, closeModal, openModal } from '@/modal.js'
import PopUpButton from '@/components/PopUpButton.vue'
</script>
<template>
    <Header />
    <PopUpButton v-if="showModal" @close="closeModal" :props="modalProps" />
    <Breadcrumbs />
    <ContactsPage />
    <Footer />
</template>