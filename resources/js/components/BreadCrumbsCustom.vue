<template>
        <Head>
             <title>{{ currentTitle }}</title>
        </Head>
  <nav class="breadcrumbs">
    <h1>{{ currentTitle }}</h1>
    <ul class="breadcrumbs_ul">
      <li v-for="(crumb, index) in breadcrumbs" :key="crumb.link">
        <template v-if="index < breadcrumbs.length - 1">
          <Link :href="crumb.link">
            {{ crumb.label }}
          </Link>
          <span class="breadcrumbs__separator">—</span>
        </template>
        <span v-else>{{ crumb.label }}</span>
      </li>
    </ul>
  </nav>
</template>

<script setup>

import { ref, onMounted, onUnmounted } from 'vue'
import { Head, usePage } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3'
import '../../css/breadcrumbs.css'

const labelmap = {
  services: 'Услуги',
  import: 'Импорт',
  about: 'О нас',
  contacts: 'Контакты',
  vacancy: 'Вакансии',
  company: 'О компании',
  plans: 'План развития',
  documents: 'Документы',
  export: 'Экспорт', 
  termoobrabotka: 'Термообработка',
  'morskie-gruzoperevozki': 'Морские грузоперевозки',
  tamozhnya: 'Таможенное оформление',
  teo : 'ТЭО (экспедирование грузов)',
  khranenie: 'Хранение',
  'zh-d-gruzoperevozki': 'Ж/Д грузоперевозки',
  'requisites': 'Реквизиты',
  news: 'Новости',
  tariffs: 'Тарифы',
}

// Реактивные данные
const currentPath = ref(window.location.pathname)
const breadcrumbs = ref([])
const currentTitle = ref('')

const { props } = usePage()

const updateBreadcrumbs = () => {
  const segments = currentPath.value.split('/').filter(Boolean)
  let path = ''
  
  const newCrumbs = [
    { label: 'Главная', link: '/' }
  ]
  
  segments.forEach((segment, i) => {
    path += `/${segment}`
    
    // Особый случай для новостей
    if (segments[i-1] === 'news' && !isNaN(segment) && props.breadcrumbData?.newsTitle) {
      newCrumbs.push({
        label: props.breadcrumbData.newsTitle,
        link: path
      })
    } else {
      newCrumbs.push({
        label: labelmap[segment] || segment.replace(/-/g, ' '),
        link: path
      })
    }
  })
  
  breadcrumbs.value = newCrumbs
  currentTitle.value = newCrumbs[newCrumbs.length - 1]?.label || ''
}

const handleUrlChange = () => {
  currentPath.value = window.location.pathname
  updateBreadcrumbs()
}

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
