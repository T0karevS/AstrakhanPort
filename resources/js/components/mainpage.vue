<template>
  <div class="mainpage-block">
    <swiper :modules="[Autoplay, Navigation, Pagination]" :autoplay="{ delay: 50000, disableOnInteraction: false }"
      :loop="true" navigation pagination class="mySwiper">
      <swiper-slide v-for="(slide, index) in slides" :key="index">
        <div class="slide-wrapper">
          <video v-if="slide.type === 'video'" :src="slide.src" autoplay muted loop playsinline></video>
          <img v-else :src="slide.src" :alt="'Slide ' + (index + 1)" />
        </div>
      </swiper-slide>
    </swiper>
    <div class="overlay_text">
      <h1>Перевалка экспортных,
        <br>
        импортных и транзитных грузов
      </h1>
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
      <div class="teasers_l1">100%</div>
      <div class="teasers_l2">Предоставляем документы, лицензии и сертификаты</div>
    </div>
    <div class="teasers_block">
      <div class="teasers_l1">24/7</div>
      <div class="teasers_l2">Заботимся о вашем времени, развитии и ресурсах</div>
    </div>
  </div>
  <div class="maincard_container">
    <div class="company_card" >
      <div class="overlay"></div>
      <div class="innercard_s">
        <div class="card-info">
          <a href="/company">
            <p class="export_text">ПАО "Астраханский порт"</p>
          </a>
          <p class="company-info">Публичное акционерное общество «Астраханский порт» - один из важнейших морских портов
            на юге России. Порт расположен на Волге, играет ключевую роль в транспортной инфраструктуре региона и
            обеспечивает связь России со странами Каспийского бассейна.'</p>
          <div class="card_buttons">
            <a href="/company" class="Ybtn">Подробнее</a>
          </div>
        </div>
        <img src="images/cardimage.jpg" alt="" />
      </div>
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

  { type: 'image', src: '/images/mainpage.jpg' },
  { type: 'video', src: '/video/mainpagevideo.mp4' },
];

</script>