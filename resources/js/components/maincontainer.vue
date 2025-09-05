<template>

  <div class="cards_container">
    <div v-for="(card, index) in visibleCards" :key="index" class="company_card" :class="{ reverse: index % 2 === 1 }">
      <div class="overlay"></div>
      <div class="innercard_s">
        <div class="card-info">
          <a :href="card.link">
            <p class="export_text">{{ card.title }}</p>
          </a>
          <p class="company-info">{{ card.description }}</p>
          <div class="card_buttons">
            <button v-if="index !== 0" @click="openModal()" class="Xbtn">Забронировать</button>
            <a :href="card.link" class="Ybtn">Подробнее</a>
          </div>
        </div>
        <img :src="card.image" alt="" />
      </div>
    </div>

    <button v-if="cards.length > maxVisible && !showAll" @click="showAll = true" class="my-button"
      :style="{ display: isServicesPage ? 'none' : 'flex' }">
      <svg class="my-icon" width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path
          d="M12.9076 10C11.8701 11.7934 9.93109 13 7.71025 13C5.4894 13 3.55037 11.7934 2.51294 10M2.51294 4C3.55037 2.2066 5.4894 1 7.71025 1C9.93109 1 11.8701 2.2066 12.9076 4"
          stroke="#999" stroke-width="2" stroke-linecap="round"></path>
        <path d="M13.7102 2V5H10.7102" stroke="#999" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        </path>
        <path d="M1.71021 12V9H4.71021" stroke="#999" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        </path>
      </svg>
      Показать ещё
    </button>
  </div>
</template>
<script setup>
import { openModal } from '@/modal.js'
import { ref, computed } from 'vue'
import { onMounted } from 'vue'

const maxVisible = 4
const showAll = ref(false)
const isServicesPage = window.location.pathname === "/services"

const cards = ref([
  
  {
    title: 'Экспорт',
    description: 'ПАО Астраханский порт предлагает Вам безопасное и надежное партнерство в области экспорта. Наш порт – важное звено в логистической цепи г.Астрахани, которое вот уже более 20 лет обеспечивает перевозку грузов между странами и континентами.',
    image: 'images/export.jpg',
    link: '/services/export'
  },
  {
    title: 'Импорт',
    description: 'Отдел импорта ПАО «Астраханский порт» является ключевым подразделением, ответственным за организацию и контроль ввоза зарубежных товаров.',
    image: 'images/export.jpg',
    link: '/services/import'
  },
  {
    title: 'Термообработка',
    description: 'Сегодня наше предприятие готово предложить комплекс услуг в области термообработки пиломатериалов и изделий из них.',
    image: 'images/termo.png',
    link: '/services/termoobrabotka'
  },
  {
    title: 'Морские грузоперевозки',
    description: 'Международные морские перевозки – это один из наиболее значимых и популярных способов доставки грузов на большие расстояния по всему миру.',
    image: 'images/marine.jpg',
    link: '/services/morskie-gruzoperevozki'
  },
  {
    title: 'Таможенное оформление',
    description: 'Таможенное оформление грузов на всей территории РФ.',
    image: 'images/tamozhnya.jpg',
    link: '/services/tamozhnya'
  },
  {
    title: 'ТЭО (экспедирование грузов)',
    description: 'Экспедирование грузов - один из важнейших пунктов логистики, к которому необходимо подойти серьезно, планируя междугородние и международные перевозки.',
    image: 'images/kran.jpg',
    link: '/services/teo'
  },
  {
    title: 'Хранение',
    description: 'Если вы ищете надежный и ответственный склад для хранения своих грузов, то вы попали по адресу!',
    image: 'images/doski.png',
    link: '/services/khranenie'
  },
  {
    title: 'ЖД грузоперевозки',
    description: 'Международные морские перевозки – это один из наиболее значимых и популярных способов доставки грузов на большие расстояния по всему миру.',
    image: 'images/poezd.jpg',
    link: '/services/zh-d-gruzoperevozki'
  },
])
// if(isServicesPage){  
const visibleCards = computed(() => {
  const startIndex = isServicesPage ? 1 : 0
  const noLimit = isServicesPage || showAll.value
  return noLimit
    ? cards.value.slice(startIndex)
    : cards.value.slice(startIndex, maxVisible)
})
document.addEventListener('DOMContentLoaded', function () {
  // Находим элементы
  const companyCards = document.querySelectorAll('.company_card');

  companyCards.forEach(card => {
    // Находим элементы внутри каждой карточки
    const exportText = card.querySelector('.export_text');
    const companyInfo = card.querySelector('.company-info');

    // Рассчитываем высоту company-info и добавляем к bottom export_text
    card.addEventListener('mouseenter', function () {
      // Получаем высоту company-info (включая padding)
      const infoHeight = companyInfo.offsetHeight;

      // Устанавливаем новое значение bottom для export_text
      // Например: текущий bottom + высота company-info + дополнительный отступ (например, 20px)
      const currentBottom = parseInt(window.getComputedStyle(exportText).bottom) || 60;
      exportText.style.bottom = `${currentBottom + infoHeight + 20}px`;
    });

    // Возвращаем исходное значение при уходе курсора
    card.addEventListener('mouseleave', function () {
      exportText.style.bottom = '60px'; // или конкретное значение, например '60px'
    });
  });
});
onMounted(() => {
  document.querySelectorAll('.company-info').forEach(el => {
    const maxLength = 120; // лимит символов
    const text = el.textContent.trim();
    if (text.length > maxLength) {
      el.textContent = text.slice(0, maxLength) + '…';
    }
  });
});
// var z = document.getElementsByClassName('.company-info').height
// document.getElementsByClassName('.export_text').bottom + z
</script>
