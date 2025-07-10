<template>
  <div class="gallery-container">
    <!-- Переключатель режимов -->
    <div class="view-toggle" v-if="images.length > 1">
      <button 
        @click="setView('slider')"
        :class="{ active: currentView === 'slider' }"
        class="toggle-btn"
      >
        Слайдер
      </button>
      <button 
        @click="setView('grid')"
        :class="{ active: currentView === 'grid' }"
        class="toggle-btn"
      >
        Сетка
      </button>
    </div>

    <!-- Уведомление если нет изображений -->
    <div v-if="images.length === 0" class="no-images">
      Изображения не загружены
    </div>

    <!-- Режим слайдера -->
    <div v-show="currentView === 'slider' && images.length > 0" class="slider-view">
      <div 
        v-for="(image, index) in images" 
        :key="'slide-' + index"
        class="slide"
        :class="{ active: currentSlide === index }"
      >
        <img 
          :src="image" 
          :alt="'Изображение ' + (index + 1)"
          @error="handleImageError"
        >
      </div>
      
      <!-- Навигация -->
      <button 
        v-if="images.length > 1"
        @click="prevSlide"
        class="slider-nav prev"
      >
        ←
      </button>
      <button 
        v-if="images.length > 1"
        @click="nextSlide"
        class="slider-nav next"
      >
        →
      </button>
    </div>

    <!-- Режим сетки -->
    <div 
      v-show="currentView === 'grid' && images.length > 0" 
      class="grid-view"
      :style="{ 'grid-template-columns': `repeat(auto-fill, minmax(${gridItemSize}px, 1fr))` }"
    >
      <div 
        v-for="(image, index) in images" 
        :key="'grid-' + index"
        class="grid-item"
        @click="openLightbox(index)"
      >
        <img 
          :src="image" 
          :alt="'Изображение ' + (index + 1)"
          @error="handleImageError"
        >
      </div>
    </div>

    <!-- Лайтбокс -->
    <div v-if="lightboxVisible" class="lightbox" @click.self="closeLightbox">
      <button class="lightbox-close" @click="closeLightbox">×</button>
      <img :src="images[lightboxIndex]" class="lightbox-image">
      <button v-if="images.length > 1" class="lightbox-nav prev" @click="prevLightbox">←</button>
      <button v-if="images.length > 1" class="lightbox-nav next" @click="nextLightbox">→</button>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted, watch } from 'vue'; 

const props = defineProps({
  images: {
    type: Array,
    default: () => []
  },
  gridItemSize: {
    type: Number,
    default: 250
  }
});


const currentView = ref('grid'); // По умолчанию сетка
const currentSlide = ref(0);
const lightboxVisible = ref(false);
const lightboxIndex = ref(0);
let slideInterval = null;

// Автоматическое определение начального режима
const autoDetectView = () => {
  currentView.value = props.images.length > 3 ? 'grid' : 'slider';
};

const setView = (view) => {
  currentView.value = view;
  resetSlider();
};

const nextSlide = () => {
  currentSlide.value = (currentSlide.value + 1) % props.images.length;
};

const prevSlide = () => {
  currentSlide.value = (currentSlide.value - 1 + props.images.length) % props.images.length;
};

const resetSlider = () => {
  currentSlide.value = 0;
};

const startAutoPlay = () => {
  if (props.images.length > 1 && currentView.value === 'slider') {
    slideInterval = setInterval(() => {
      nextSlide();
    }, 5000);
  }
};

const stopAutoPlay = () => {
  if (slideInterval) {
    clearInterval(slideInterval);
  }
};

const openLightbox = (index) => {
  lightboxIndex.value = index;
  lightboxVisible.value = true;
};

const closeLightbox = () => {
  lightboxVisible.value = false;
};

const nextLightbox = (e) => {
  e.stopPropagation();
  lightboxIndex.value = (lightboxIndex.value + 1) % props.images.length;
};

const prevLightbox = (e) => {
  e.stopPropagation();
  lightboxIndex.value = (lightboxIndex.value - 1 + props.images.length) % props.images.length;
};

const handleImageError = (e) => {
  e.target.src = '/images/image-placeholder.jpg'; // Запасное изображение
};

// Обработка клавиатуры
const handleKeyDown = (e) => {
  if (lightboxVisible.value) {
    if (e.key === 'Escape') closeLightbox();
    if (e.key === 'ArrowRight') nextLightbox(e);
    if (e.key === 'ArrowLeft') prevLightbox(e);
  }
};

onMounted(() => {
  autoDetectView();
  startAutoPlay();
  window.addEventListener('keydown', handleKeyDown);
});

onUnmounted(() => {
  stopAutoPlay();
  window.removeEventListener('keydown', handleKeyDown);
});

// Следим за изменением images
watch(() => props.images, (newVal) => {
  if (newVal.length > 0) {
    autoDetectView();
    resetSlider();
    stopAutoPlay();
    startAutoPlay();
  }
});
</script>

<style scoped>
.gallery-container {
  max-width: 1200px;
  margin: 2rem auto;
  position: relative;
}

.view-toggle {
  display: flex;
  margin-bottom: 20px;
  gap: 10px;
}

.toggle-btn {
  padding: 8px 16px;
  cursor: pointer;
  background: #f0f0f0;
  border: none;
  border-radius: 4px;
  transition: all 0.3s;
}

.toggle-btn.active {
  background: #3a86ff;
  color: white;
}

.toggle-btn:hover {
  opacity: 0.9;
}

/* Слайдер */
.slider-view {
  position: relative;
  overflow: hidden;
  height: 500px;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.slide {
  position: absolute;
  width: 100%;
  height: 100%;
  opacity: 0;
  transition: opacity 0.5s ease;
}

.slide.active {
  opacity: 1;
}

.slide img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.slider-nav {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background: rgba(0,0,0,0.5);
  color: white;
  border: none;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  cursor: pointer;
  z-index: 10;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.2rem;
  transition: background 0.3s;
}

.slider-nav:hover {
  background: rgba(0,0,0,0.7);
}

.slider-nav.prev { left: 20px; }
.slider-nav.next { right: 20px; }

/* Сетка */
.grid-view {
  display: grid;
  gap: 15px;
  margin-top: 20px;
}

.grid-item {
  overflow: hidden;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
  transition: transform 0.3s, box-shadow 0.3s;
  aspect-ratio: 4/3;
  cursor: pointer;
}

.grid-item:hover {
  transform: translateY(-5px);
  box-shadow: 0 6px 12px rgba(0,0,0,0.15);
}

.grid-item img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.5s;
}

.grid-item:hover img {
  transform: scale(1.05);
}

/* Лайтбокс */
.lightbox {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0,0,0,0.9);
  z-index: 1000;
  display: flex;
  align-items: center;
  justify-content: center;
}

.lightbox-close {
  position: absolute;
  top: 20px;
  right: 20px;
  background: none;
  border: none;
  color: white;
  font-size: 2rem;
  cursor: pointer;
  z-index: 1001;
}

.lightbox-image {
  max-height: 90vh;
  max-width: 90vw;
  object-fit: contain;
}

.lightbox-nav {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background: rgba(255,255,255,0.2);
  color: white;
  border: none;
  width: 50px;
  height: 50px;
  border-radius: 50%;
  cursor: pointer;
  z-index: 1001;
  font-size: 1.5rem;
}

.lightbox-nav.prev { left: 20px; }
.lightbox-nav.next { right: 20px; }

.lightbox-nav:hover {
  background: rgba(255,255,255,0.3);
}

/* Нет изображений */
.no-images {
  padding: 2rem;
  text-align: center;
  background: #f5f5f5;
  border-radius: 8px;
  color: #666;
}
</style>