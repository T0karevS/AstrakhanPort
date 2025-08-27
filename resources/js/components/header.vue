<template>
  <header class="main-header" :style="{ opacity: showScrollHeader ? 0 : 1, color: isHome ? '#ffffff' : '#000000' }">
    <a href="/"><img id="logo-img" :src="isHome ? '/images/sss.svg' : '/images/sss1.svg'" alt=""></a>

    <div class="menu_items">
      <div class="dropdown-container" v-for="menu in menus" :key="menu.title">
        <a :href="menu.link">
          <p>{{ menu.title }}</p>
        </a>
        <ul class="dropdown" v-if="menu.items">
          <li v-for="item in menu.items" :key="item.title"><a :href="item.link">{{ item.title }}</a></li>
        </ul>
      </div>
      <a href="/tariffs">
        <p>Тарифы</p>
      </a>
      <a href="/news">
        <p>Новости</p>
      </a>
      <a href="/contacts">
        <p>Контакты</p>
      </a>  
    </div>

    <div class="HeaderDiv">
      <img class="HeaderSearch" src="/images/21312.svg" alt="">
      <button @click="openModal()" class="BtnZ">Подать заявку</button>
    </div>

  </header>

  <header class="scroll-header" :class="{ visible: showScrollHeader }">
    <a href="/"><img src="/images/sss1.svg" alt=""></a>
    <div class="contact-data">
      <i><!-- svg --></i>
      <p class="phone_number">+7 (8512) 44-28-88</p>
    </div>
    <div class="HeaderDiv">
      <img class="HeaderSearch" src="/images/21312.svg" alt="">
      <button @click="openModal()" class="BtnZ">Подать заявку</button>
    </div>
    <PopUpButton v-if="showModal" @close="closeModal" :props="modalProps" />
  </header>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { usePage } from '@inertiajs/vue3'

import '../../css/style.css';
import '../../css/header.css';

const page = usePage()
const isServiceSubpage = /^\/services\/[a-z-]+/.test(page.url)
const isHome = page.url === '/' || isServiceSubpage
import { showModal, modalProps, closeModal, openModal } from '@/modal.js'
const showScrollHeader = ref(false)
// const showModal = ref(false)

function handleScroll() {
  showScrollHeader.value = window.scrollY > 100
}
import PopUpButton from '@/components/PopUpButton.vue'

// function openModal() {
//   showModal.value = true
// }

// function closeModal() {
//   showModal.value = false
// }

// dropdown logic
onMounted(() => {
  window.addEventListener('scroll', handleScroll)

  const containers = document.querySelectorAll('.dropdown-container')
  containers.forEach(container => {
    let timeout
    container.addEventListener('mouseenter', () => {
      clearTimeout(timeout)
      container.classList.add('active')
    })
    container.addEventListener('mouseleave', () => {
      timeout = setTimeout(() => {
        container.classList.remove('active')
      }, 3)
    })
  })
})

const menus = [
  { title: 'Главная', link: '/' },
  {
    title: 'О компании', link: '/company',
    items: [
      { title: 'Документы', link: '/company/documents' },
      { title: 'План развития', link: '/company/plans' },
      { title: 'Реквизиты', link: '/company/requisites' },
      { title: 'Вакансии', link: '/company/vacancy' },
    ]
  },
  {
    title: 'Услуги', link: '/services', items: [
      { title: 'Импорт', link: '/services/import' },
      { title: 'Экспорт', link: '/services/export' },
      { title: 'Термообработка', link: '/services/termoobrabotka' },
      { title: 'Морские грузоперевозки', link: '/services/morskie-gruzoperevozki' },
      { title: 'ТЭО (экспедирование грузов)', link: '/services/teo' },
      { title: 'Таможенное оформление', link: '/services/tamozhnya' },
      { title: 'Ж/Д грузоперевозки', link: '/services/zh-d-gruzoperevozki' },
      { title: 'Хранение', link: '/services/khranenie' },
    ]
  }
]
</script>
