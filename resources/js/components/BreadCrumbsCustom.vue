<template>
        <head>
             <title>{{ $page.component }} - {{ $page.props.breadcrumbTitle }}</title>
        </head>
  <nav class="breadcrumbs">
    <h1>{{ currentTitle }}</h1>
    <ul class="breadcrumbs_ul">
      <li v-for="(crumb, index) in breadcrumbs" :key="crumb.link">
        <template v-if="index < breadcrumbs.length - 1">
          <Link :href="crumb.link">
            {{ crumb.label }}
          </Link>
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 200 20">
            <line x1="10" y1="10" x2="190" y2="10" stroke="black" stroke-width="2" stroke-linecap="round"/>
          </svg>
        </template>
        <span v-else>{{ crumb.label }}</span>
      </li>
    </ul>
  </nav>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import { Link } from '@inertiajs/vue3'
import '../../css/breadcrumbs.css'

const labelmap = {
  services: 'Услуги',
  Import: 'Импорт',
  about: 'О нас',
  contacts: 'Контакты',
  vacancy: 'Вакансии',
  company: 'О компании',
  plans: 'План развития',
  documents: 'Документы'
}

// Реактивные данные
const currentPath = ref(window.location.pathname)
const breadcrumbs = ref([])
const currentTitle = ref('')

// Функция обновления крошек
const updateBreadcrumbs = () => {
  const segments = currentPath.value.split('/').filter(Boolean)
  let path = ''
  
  const newCrumbs = [
    { label: 'Главная', link: '/' }
  ]
  
  segments.forEach(segment => {
    path += `/${segment}`
    newCrumbs.push({
      label: labelmap[segment] || segment.replace(/-/g, ' '),
      link: path
    })
  })
  
  breadcrumbs.value = newCrumbs
  currentTitle.value = newCrumbs[newCrumbs.length - 1]?.label || ''
}

// Слушатель изменений URL
const handleUrlChange = () => {
  currentPath.value = window.location.pathname
  updateBreadcrumbs()
}

// Настройка MutationObserver для отслеживания изменений в DOM
const setupDOMObserver = () => {
  const observer = new MutationObserver(() => {
    if (window.location.pathname !== currentPath.value) {
      handleUrlChange()
    }
  })
  
  observer.observe(document.body, {
    childList: true,
    subtree: true,
    attributes: true
  })
  
  return observer
}

// Инициализация
onMounted(() => {
  updateBreadcrumbs()
  window.addEventListener('popstate', handleUrlChange)
  window.addEventListener('inertia:navigate', handleUrlChange)
  const observer = setupDOMObserver()
  
  onUnmounted(() => {
    window.removeEventListener('popstate', handleUrlChange)
    window.removeEventListener('inertia:navigate', handleUrlChange)
    observer.disconnect()
  })
})
</script>
