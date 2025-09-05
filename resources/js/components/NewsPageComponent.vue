<template>
  <div class="newsdiv">
    <img :src="'/'+$page.props.newsItem.images[0]" alt="">
    <div v-html="$page.props.newsItem.text"></div>
    <div>{{ $page.props.newsItem.date }}</div>

      <!-- Галерея изображений -->
    <div class="gallery" v-if="$page.props.newsItem.images.length > 1">
      <h3>Галерея</h3>
      <div class="gallery-grid">
        <img 
          v-for="(image, index) in $page.props.newsItem.images" 
          :key="index"
          :src="'/'+image" 
          alt=""
          @click="openLightbox(index)"
          class="gallery-thumbnail"
        >
      </div>
    </div>
    
    <!-- Лайтбокс для просмотра изображений -->
    <div class="lightbox" v-if="showLightbox" @click.self="closeLightbox">
      <button class="close-btn" @click="closeLightbox">&times;</button>
      <button class="nav-btn prev-btn" @click.stop="prevImage">&lt;</button>
      <img :src="'/'+$page.props.newsItem.images[currentImageIndex]" class="lightbox-image">
      <button class="nav-btn next-btn" @click.stop="nextImage">&gt;</button>
    </div>
  </div>
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

// Логика для лайтбокса
const showLightbox = ref(false);
const currentImageIndex = ref(0);

const openLightbox = (index) => {
  currentImageIndex.value = index;
  showLightbox.value = true;
};

const closeLightbox = () => {
  showLightbox.value = false;
};

const prevImage = () => {
  currentImageIndex.value = (currentImageIndex.value - 1 + props.newsItem.images.length) % props.newsItem.images.length;
};

const nextImage = () => {
  currentImageIndex.value = (currentImageIndex.value + 1) % props.newsItem.images.length;
};

// Закрытие по ESC
document.addEventListener('keydown', (e) => {
  if (e.key === 'Escape' && showLightbox.value) {
    closeLightbox();
  }
});
</script>

<style scoped>
.newsdiv {
  max-width: 1200px;
  margin: 0 150px;
  padding: 20px 0;
}

.main-image {
  width: 100%;
  max-height: 400px;
  object-fit: cover;
  margin-bottom: 20px;
}

.news-date {
  color: #666;
  margin: 10px 0;
}

.gallery {
  margin-top: 30px;
}

.gallery h3 {
  margin-bottom: 15px;
}

.gallery-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
  gap: 10px;
}

.gallery-thumbnail {
  width: 100%;
  height: 150px;
  object-fit: cover;
  cursor: pointer;
  transition: transform 0.2s;
}

.gallery-thumbnail:hover {
  transform: scale(1.03);
}

.lightbox {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.8);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1000;
}

.lightbox-image {
  max-height: 80vh;
  max-width: 80vw;
}

.close-btn {
  position: absolute;
  top: 20px;
  right: 20px;
  background: none;
  border: none;
  color: white;
  font-size: 30px;
  cursor: pointer;
}

.nav-btn {
  background: rgba(255, 255, 255, 0.3);
  border: none;
  color: white;
  padding: 10px 20px;
  margin: 0 10px;
  font-size: 24px;
  cursor: pointer;
  border-radius: 5px;
}

.nav-btn:hover {
  background: rgba(255, 255, 255, 0.5);
}

.prev-btn {
  position: absolute;
  left: 20px;
}

.next-btn {
  position: absolute;
  right: 20px;
}
@media (max-width: 320px) {
  .newsdiv{
    width: 90%;
    margin: auto;
  }  
}
</style>