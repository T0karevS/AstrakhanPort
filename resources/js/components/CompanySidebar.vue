<template>
  <nav class="sidebar">
    <Link 
      href="/company/about" 
      as="button" 
      class="menu-item"
      :class="{ 'active': $page.url === '/company/about' }"
      preserve-state
      preserve-scroll
    >
      О компании
    </Link>

    <Link 
      href="/company/documents" 
      as="button" 
      class="menu-item"
      :class="{ 'active': $page.url.startsWith('/company/documents') }"
      preserve-state
      preserve-scroll
    >
      Документы
    </Link>
  </nav>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<style scoped>
.menu-item.active {
  background: #eef2ff;
  font-weight: bold;
}
</style>