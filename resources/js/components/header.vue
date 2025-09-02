<template>
  <header class="main-header" :style="{ opacity: showScrollHeader ? 0 : 1, color: isHome ? '#ffffff' : '#000000' }">
    <a href="/"><img id="logo-img" :src="isHome ? '/images/sss.svg' : '/images/sss1.svg'" alt=""></a>
    <!-- <div v-if="openMenuModal" class="menu-modal" @click.self="openMenuModal = false"> -->
       <!-- <div class="menu-modal-content"> -->
        <span @click="openMenuModal = false" class="close">&times;</span>

        <div class="menu_items" :class="{ 'is-modal': openMenuModal }">
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
      <!-- </div>
    </div> -->
    <div class="HeaderDiv">
      <button @click="openModal()" class="BtnZ">Подать заявку</button>
      <span class="burger mobile-only" @click="openMenuModal = true">☰</span>
    </div>

  </header>

  <header class="scroll-header" :class="{ visible: showScrollHeader }">
    <a href="/"><img src="/images/sss1.svg" alt=""></a>

    <div class="contact-data">
      <i><!-- svg --></i>
      <p class="phone_numberX">+7 (8512) 44-28-88</p>
      <div class="dropdown2">

        <p class="contactsl1">Адрес:</p>
        <p class="contactsl2">Астрахань, г.Астрахань, ул Пушкина, 66</p>
        <p class="contactsl1">Email</p>
        <p class="contactsl2">astrakhanport@mail.ru</p>
        <p class="contactsl1">Режим работы</p>
        <p class="contactsl2">Пн. – Пт.: с 9:00 до 18:00</p>
      </div>
    </div>
    <div class="HeaderDiv">
      <!-- <img class="HeaderSearch" src="/images/21312.svg" alt=""> -->
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
import { watch } from 'vue'


const openMenuModal = ref(false)
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
watch(openMenuModal, (val) => {
  document.body.style.overflow = val ? 'hidden' : ''
})
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

<style>
.burger, .close {
  display: none;
}

.dropdown-container a{
  width: fit-content;
}

.menu_items {
  display: flex;
  gap: 20px;
  position: static;
  justify-content: space-between;
  background: none;
}

.menu_items a {
  text-decoration: none;
  font-size: 18px;
}

.menu_items .dropdown {
  padding-left: 15px;
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.burger {
  font-size: 28px;
  cursor: pointer;
  margin-left: 20px;
}

.menu-modal .dropdown {
  display: flex !important;
  flex-direction: column;
  gap: 10px;
  padding-left: 15px;
}

.burger {
  display: none;
}

.menu-modal {
  display: none;
  /* модалка скрыта пока не открыта */
}

/* Для экранов 768px и меньше */
@media (max-width: 768px) {
  .burger {
    display: block;
  }

  .menu_items {
    display: none;
    
  }
  .menu_items a{
    
  color: #000;
  }

  .menu_items.is-modal {
    display: flex;
    flex-direction: column;
    gap: 15px;

    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: white;
    z-index: 9999;
    padding: 20px;
  }

  .menu_items .close {
    position: absolute;
    top: 10px;
    right: 15px;
    font-size: 28px;
    cursor: pointer;
  }

  .menu_items {
    display: none;
    /* обычное меню скрываем */
  }

  /* модалка показывается только когда openMenuModal = true через v-if */
  .menu-modal {
    display: flex;
  }
}
</style>