<template>
  <div class="p-4">
    <h1 class="text-2xl mb-4">Документы</h1>

    <!-- форма добавления -->
    <form @submit.prevent="submit" class="mb-4 space-y-2">
      <input v-model="form.doc_name" type="text" placeholder="Название документа" class="border p-2 w-full" />
      <input v-model="form.doc_category" type="text" placeholder="Категория" class="border p-2 w-full" />
      <input v-model="form.doc_year" type="text" placeholder="Год (YYYY)" class="border p-2 w-full" />
      <input type="file" @change="onFileChange" />
      <button class="bg-black text-white px-4 py-2">Добавить</button>
    </form>

    <!-- список документов -->
    <ul v-if="documents && documents.length">
      <li v-for="doc in documents" :key="doc.id" class="flex justify-between items-center mb-2">
        <span>
          <a :href="`/storage/${doc.doc_link}`" target="_blank" class="document-link">{{ doc.doc_name }}</a>
          ({{ doc.doc_year }}, {{ doc.doc_category }})
        </span>
        <div class="space-x-2">
          <button @click="openEditModal(doc)" class="text-blue-500">Редактировать</button>
          <button @click="deleteDocument(doc.id)" class="text-red-500">Удалить</button>
        </div>
      </li>
    </ul>
    <p v-else class="text-gray-500">Документов нет</p>

    <!-- модалка редактирования -->
    <div v-if="showModal" class="fixed inset-0 z-50 bg-black/50 flex items-center justify-center">
      <div class="bg-white p-6 rounded shadow-lg w-96">
        <h2 class="text-xl mb-4">Редактировать документ</h2>
        <form @submit.prevent="updateDocument" class="space-y-2" enctype="multipart/form-data">
          <input v-model="editForm.doc_name" type="text" class="border p-2 w-full" />
          <input v-model="editForm.doc_category" type="text" class="border p-2 w-full" />
          <input v-model="editForm.doc_year" type="text" class="border p-2 w-full" />
          <input type="file" @change="onEditFileChange" />

          <div class="flex justify-end space-x-2 mt-4">
            <button type="button" @click="closeModal" class="px-4 py-2 bg-gray-300 rounded">Отмена</button>
            <button type="submit" :disabled="editForm.processing" class="px-4 py-2 bg-blue-600 text-white rounded">
              Сохранить
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useForm, router } from '@inertiajs/vue3'

// props
const { documents } = defineProps({
  documents: Array
})

// форма добавления
const form = useForm({
  doc_name: '',
  doc_category: '',
  doc_year: '',
  doc_link: null,
})

function onFileChange(e) {
  form.doc_link = e.target.files[0]
}

function submit() {
  form.post('/admin/documents', {
    forceFormData: true,
    onSuccess: () => {
      form.reset()
      router.get('/admin', { preserveState: true })
    },
  })
}

// удаление
function deleteDocument(id) {
  router.delete(`/admin/documents/${id}`, {
    onSuccess: () => window.location.reload(),
  })
}

// модалка редактирования
const showModal = ref(false)
let editingId = null

const editForm = useForm({
  doc_name: '',
  doc_category: '',
  doc_year: '',
  doc_link: null,
})

function openEditModal(doc) {
  editingId = doc.id
  editForm.doc_name = doc.doc_name
  editForm.doc_category = doc.doc_category
  editForm.doc_year = doc.doc_year
  editForm.doc_link = null
  showModal.value = true
}

function onEditFileChange(e) {
  editForm.doc_link = e.target.files[0]
}

function updateDocument() {
  const data = new FormData()
  data.append('doc_name', editForm.doc_name)
  data.append('doc_category', editForm.doc_category)
  data.append('doc_year', editForm.doc_year)
  if (editForm.doc_link) data.append('doc_link', editForm.doc_link)

  router.post(`/admin/documents/${editingId}`, data, {
    headers: { 'X-HTTP-Method-Override': 'PUT' },
    onSuccess: () => {
      closeModal()
      router.get('/admin', { preserveState: true })
    },
    onError: errors => console.log(errors),
  })
}

function closeModal() {
  showModal.value = false
  editingId = null
  editForm.reset()
}
</script>
