<template>
    <div class="p-4">
        <h1 class="text-2xl mb-4">Документы</h1>

        <form @submit.prevent="submit" class="mb-4 space-y-2">
            <input v-model="form.doc_name" type="text" placeholder="Название документа" class="border p-2 w-full" />
            <input v-model="form.doc_category" type="text" placeholder="Категория" class="border p-2 w-full" />
            <input v-model="form.doc_year" type="text" placeholder="Год (YYYY)" class="border p-2 w-full" />
            <input type="file" @change="onFileChange" />
            <button class="bg-black text-white px-4 py-2">Добавить</button>
        </form>

        <ul v-if="props.documents && props.documents.length">
  <li v-for="doc in props.documents" :key="doc.id" class="flex justify-between items-center mb-2">
        <span> <a :href="`/storage/${doc.doc_link}`" target="_blank" class="document-link">{{ doc.doc_name }} </a>({{ doc.doc_year }}, {{ doc.doc_category }})</span>
        <button @click="deleteDocument(doc.id)" class="text-red-500">
            Удалить
        </button>
    </li>
</ul>
<p v-else class="text-gray-500">Документов нет</p>  
    </div>
</template>

<script setup>
import { useForm, router } from '@inertiajs/vue3'
const props = defineProps(['documents']);
console.log(props.documents);

console.log('docs:', props.documents)
const form = useForm({
    doc_name: '',
    doc_link: null,
    doc_category: '',
    doc_year: '',
})

function onFileChange(e) {
    form.doc_link = e.target.files[0]
}

function submit() {
  form.post(route('admin.documents.store'), {
    forceFormData: true,
    onSuccess: () => {
      form.reset()
      router.get(route('admin.dashboard'), { preserveState: true })
    },
  })
}

function deleteDocument(id) {
  router.delete(route('admin.documents.destroy', id), {
    onSuccess: () => {
      window.location.reload()
    },
  })
}
</script>