<template>
   
  <div class="cards_container">
    <div
      v-for="(card, index) in visibleCards"
      :key="index"
      class="company_card"
      :class="{ reverse: index % 2 === 1 }"
    >
      <div class="innercard_s">
        <div class="card-info">
          <a :href="card.link">
            <p class="export_text">{{ card.title }}</p>
          </a>
          <p class="company-info">{{ card.description }}</p>
          <div class="card_buttons">
            <button class="Xbtn">Забронировать</button>
            <button class="Ybtn">Подробнее</button>
          </div>
        </div>
        <img :src="card.image" alt="" />
      </div>
    </div>

    <button v-if="cards.length > maxVisible && !showAll" @click="showAll = true" class="my-button">
        <svg class="my-icon" width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12.9076 10C11.8701 11.7934 9.93109 13 7.71025 13C5.4894 13 3.55037 11.7934 2.51294 10M2.51294 4C3.55037 2.2066 5.4894 1 7.71025 1C9.93109 1 11.8701 2.2066 12.9076 4" stroke="#999" stroke-width="2" stroke-linecap="round"></path>
            <path d="M13.7102 2V5H10.7102" stroke="#999" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M1.71021 12V9H4.71021" stroke="#999" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
      Показать ещё
    </button>
  </div>
</template>
<script setup>

import { ref, computed } from 'vue'

const maxVisible = 4
const showAll = ref(false)

const cards = ref([
    {
    title: 'ПАО "Астраханский порт"',
    description: 'Публичное акционерное общество «Астраханский порт» - один из важнейших морских портов на юге России. Порт расположен на Волге, играет ключевую роль в транспортной инфраструктуре региона и обеспечивает связь России со странами Каспийского бассейна.',
    image: 'images/cardimage.jpg',
    link: '/'
  },  
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
    link: '/services/export'
  },
  {
    title: 'Морские грузоперевозки',
    description: 'Международные морские перевозки – это один из наиболее значимых и популярных способов доставки грузов на большие расстояния по всему миру.',
    image: 'images/marine.jpg',
    link: '/services'
  },
  {
    title: 'Таможенное оформление',
    description: 'Таможенное оформление грузов на всей территории РФ.',
    image: 'images/tamozhnya.jpg',
    link: '/services'
  },
  {
    title: 'ТЭО (экспедирование грузов)',
    description: 'Экспедирование грузов - один из важнейших пунктов логистики, к которому необходимо подойти серьезно, планируя междугородние и международные перевозки.',
    image: 'images/kran.jpg',
    link: '/services'
  },
  {
    title: 'Хранение',
    description: 'Если вы ищете надежный и ответственный склад для хранения своих грузов, то вы попали по адресу!',
    image: 'images/doski.png',
    link: '/services'
  },
  {
    title: 'ЖД грузоперевозки',
    description: 'Международные морские перевозки – это один из наиболее значимых и популярных способов доставки грузов на большие расстояния по всему миру.',
    image: 'images/poezd.jpg',
    link: '/services'
  },
])

const visibleCards = computed(() =>
  showAll.value ? cards.value : cards.value.slice(0, maxVisible)
)
</script>