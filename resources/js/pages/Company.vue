
<template>
    <Header />
    <BreadCrumbsCustom :key="$page.url" />
  <div>
    <nav class="company-nav">
      <button @click="setActiveTab('about')">О компании</button>
      <button @click="setActiveTab('documents')">Документы</button>
      <button @click="setActiveTab('plans')">План развития</button>
      <button @click="setActiveTab('vacancy')">Вакансии</button>
    </nav>

    <div class="company-content">
      <component :is="activeComponent" />
    </div>
  </div>
  <Footer />
</template>

<script setup>
import Header from '@/components/header.vue'
import Footer from '@/components/footer.vue'
import BreadCrumbsCustom from '@/components/BreadCrumbsCustom.vue'
import CompanySidebar from '@/components/CompanySidebar.vue'
import { ref, computed, onMounted, watch, onUnmounted } from 'vue'
import { router } from '@inertiajs/vue3'
import About from '@/components/About.vue'
import Plans from '@/components/Plans.vue'
import Documents from '@/components/Documents.vue'
import VacancyComponent from '@/components/VacancyComponent.vue'
// import Development from './Development.vue'
// import Contacts from './Contacts.vue'

onMounted(() => {
    document.title = 'О компании';
})
const props = defineProps({
  initialSection: {
    type: String,
    default: 'about'
  }
})

// Доступные разделы
const validTabs = ['about', 'documents', 'plans', 'vacancy']

// Проверяем, что переданный раздел допустим
const initialTab = validTabs.includes(props.initialSection) 
  ? props.initialSection 
  : 'about'

const activeTab = ref(initialTab)

const components = {
  about: About,
  documents: Documents,
  plans: Plans,
  vacancy: VacancyComponent,
}

const activeComponent = computed(() => components[activeTab.value])

// Обработка изменения URL через кнопки браузера "назад/вперед"
onMounted(() => {
  window.addEventListener('popstate', handleRouteChange)
  
  // Первичная проверка URL при загрузке
  handleRouteChange()
})

// Функция для обработки изменений URL
function handleRouteChange() {
  const path = window.location.pathname
  const sections = path.split('/')
  const section = sections[sections.length - 1]
  
  if (validTabs.includes(section) && section !== activeTab.value) {
    activeTab.value = section
  } else if (!validTabs.includes(section)) {
    // Если раздел не существует, перенаправляем на about
    window.history.replaceState({}, '', '/company/about')
    activeTab.value = 'about'
  }
}

// Функция переключения табов
function setActiveTab(tab) {
  if (!validTabs.includes(tab)) return
  
  activeTab.value = tab
  // Обновляем URL без перезагрузки страницы
  window.history.pushState({}, '', `/company/${tab}`)
}

// Очистка слушателя событий при размонтировании компонента
onUnmounted(() => {
  window.removeEventListener('popstate', handleRouteChange)
})
</script>