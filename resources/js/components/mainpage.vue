<template>
    <div class="mainpage-block">
         <swiper
            :modules="[Autoplay, Navigation, Pagination]"
            :autoplay="{ delay: 50000, disableOnInteraction: false }"
            :loop="true"
            navigation
            pagination
            class="mySwiper"
        >
    <swiper-slide v-for="(slide, index) in slides" :key="index">
      <div class="slide-wrapper">
        <video
          v-if="slide.type === 'video'"
          :src="slide.src" 
          autoplay muted loop playsinline
        ></video>
        <img
          v-else
          :src="slide.src"
          :alt="'Slide ' + (index + 1)"
        />
      </div>
    </swiper-slide>
  </swiper>
        <div class="overlay_text">
            <h1>Перевалка экспортных,
                <br>
            импортных и транзитных грузов</h1>
        </div>
    </div>
    <div class="teasers">
        <div class="teasers_block">
            <div class="teasers_l1">500+</div>
            <div class="teasers_l2">Мы надежные партнеры</div>
        </div>
        <div class="teasers_block">
            <div class="teasers_l1">24/7</div>
            <div class="teasers_l2">Готовы отвечать на вопросы в любое время</div>
        </div>
        <div class="teasers_block">
            <div class="teasers_l1">500+</div>
            <div class="teasers_l2">Мы надежные партнеры</div>
        </div>
        <div class="teasers_block">
            <div class="teasers_l1">24/7</div>
            <div class="teasers_l2">Мы надежные партнеры</div>
        </div>
    </div>
</template>
<script setup>
import '../../css/style.css'
import { Swiper, SwiperSlide } from 'swiper/vue';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

import { Autoplay, Navigation, Pagination } from 'swiper/modules';

const slides = [
  { type: 'video', src: '/video/mainpagevideo.mp4' },
  { type: 'image', src: '/images/mainpage.jpg' },
];

</script>