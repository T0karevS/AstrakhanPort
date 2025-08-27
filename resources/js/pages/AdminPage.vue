<!-- <template>
  <Documents :documents="documents" />
  <Vacancies :vacancies="vacancies" />
</template>

<script setup>
import { usePage } from '@inertiajs/vue3';
import Documents from '@/components/AdminDocuments.vue';
import Vacancies from '@/components/AdminVacancies.vue'
const { documents } = usePage().props;
const props = defineProps(['documents']);
console.log(props);
</script> -->
<template>
  <div class="p-4">
    <h1 class="text-2xl mb-4">Админ панель</h1>

    <div class="flex space-x-4 mb-4">
      <button @click="activeTab = 'documents'" :class="tabClass('documents')">Документы</button>
      <button @click="activeTab = 'vacancies'" :class="tabClass('vacancies')">Вакансии</button>
      <button @click="activeTab = 'news'" :class="tabClass('news')">Новости</button>
    </div>

    <Documents v-if="activeTab === 'documents'" :documents="documents" />
    <Vacancies v-if="activeTab === 'vacancies'" :vacancies="vacancies" />
    <News v-if="activeTab === 'news'" :news="news" />
  </div>
</template>

<script setup>
import { ref } from 'vue'
import Documents from '@/components/AdminDocuments.vue';
import Vacancies from '@/components/AdminVacancies.vue';
import News from '@/components/AdminNews.vue';

// Props приходят напрямую из Inertia
const props = defineProps({
  documents: Array,
  vacancies: Array,
  news: Array,
})

const activeTab = ref('documents')

function tabClass(tab) {
  return activeTab.value === tab
    ? 'bg-black text-white px-4 py-2'
    : 'bg-gray-200 text-black px-4 py-2'
}
</script>