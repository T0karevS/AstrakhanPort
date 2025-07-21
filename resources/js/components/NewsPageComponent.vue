<template>
  <img :src="'/'+$page.props.newsItem.images[0]" alt="">
    <div v-html="$page.props.newsItem.text"></div>
</template>
<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';

const props = defineProps({
  newsItem: {
    type: Object,
    required: true
  },
  images: {
    type: Array,
    default: () => []
  }
});
</script>

<style scoped>
.news-page {
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
}

.news-title {
  font-size: 2rem;
  margin-bottom: 15px;
  color: #333;
}

.news-date {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-bottom: 25px;
  color: #666;
  font-size: 0.9rem;
}

.news-gallery {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 15px;
  margin: 30px 0;
}

.news-image {
  width: 100%;
  height: auto;
  border-radius: 8px;
  cursor: pointer;
  transition: transform 0.3s;
}

.news-image:hover {
  transform: scale(1.02);
}

.news-content {
  line-height: 1.6;
  font-size: 1.1rem;
}

.news-content :deep(p) {
  margin-bottom: 1em;
}

.news-content :deep(img) {
  max-width: 100%;
  height: auto;
  margin: 20px 0;
  border-radius: 8px;
}
</style>