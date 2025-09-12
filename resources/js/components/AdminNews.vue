<template>
  <div class="p-4">
    <h1 class="text-2xl mb-4">Новости</h1>

    <!-- форма добавления -->
    <form @submit.prevent="submit" class="mb-4 space-y-2" enctype="multipart/form-data">
      <input v-model="form.name" type="text" placeholder="Заголовок" class="border p-2 w-full" />

      <div>
        <div ref="editor" class="border min-h-[200px] p-2"></div>
      </div>

      <input v-model="form.date" type="date" class="border p-2 w-full" />
      <input type="file" multiple @change="onFileChange" />
      <button class="bg-black text-white px-4 py-2">Добавить</button>
    </form>

    <ul v-if="props.news.length">
      <li v-for="item in props.news" :key="item.id" class="mb-4 border p-2">
        <h2>{{ item.name }} ({{ item.date }})</h2>
        <div v-html="item.text"></div>
        <div v-for="img in item.images" class="flex space-x-2 mt-2">
          <img  :key="img.id" :src="`/${img.image_path}`" class="w-20 h-20 object-cover"/>
          <button type="button" @click="deleteImage(img.id)"
            class="delete_button">×</button>
        </div>
        <div class="flex space-x-2 mt-2">
          <button @click="openEditModal(item)" class="text-blue-500">Редактировать</button>
          <button @click="deleteNews(item.id)" class="text-red-500">Удалить</button>
        </div>
      </li>
    </ul>

    <!-- Модалка редактирования -->
    <div v-show="showModal" class="fixed inset-0 z-50 bg-black/50 flex items-center justify-center">
      <div class="bg-white p-6 rounded shadow-lg w-96">
        <h2 class="text-xl mb-4">Редактировать новость</h2>
        <form @submit.prevent="updateNews" class="space-y-2">
          <input v-model="editForm.name" type="text" class="border p-2 w-full" />
          <div>
            <div ref="editEditor" class="border min-h-[200px] p-2"></div>
          </div>
          <input v-model="editForm.date" type="date" class="border p-2 w-full" />
          <input type="file" multiple @change="onEditFileChange" />
          <div class="flex justify-end space-x-2 mt-4">
            <button type="button" @click="closeModal" class="px-4 py-2 bg-gray-300 rounded">Отмена</button>
            <button type="submit" :disabled="editForm.processing"
              class="px-4 py-2 bg-blue-600 text-white rounded">Сохранить</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, nextTick } from 'vue'
import { useForm, router } from '@inertiajs/vue3'
import Quill from 'quill'
import 'quill/dist/quill.snow.css'
const props = defineProps({ news: Array })

const form = useForm({
  name: '',
  text: '',
  date: '',
  images: []
})

const editor = ref(null)
let quill

onMounted(() => {
  quill = new Quill(editor.value, { theme: 'snow', modules: { toolbar: [['bold', 'italic'], ['link']] } })
  quill.on('text-change', () => form.text = quill.root.innerHTML)
})

function onFileChange(e) {
  form.images = Array.from(e.target.files)
}

function submit() {
  form.post(route('admin.news.store'), { forceFormData: true, onSuccess: () => router.get(route('admin.news.index'), { preserveState: true }) })
}

function deleteNews(id) {
  router.delete(route('admin.news.destroy', id), { onSuccess: () => router.get(route('admin.news.index'), { preserveState: true }) })
}

// редактирование
const showModal = ref(false)
let editingId = null

const editForm = useForm({ name: '', text: '', date: '', images: [] })
const editEditor = ref(null)
let editQuill

function openEditModal(item) {
  editingId = item.id
  editForm.name = item.name
  editForm.text = item.text
  editForm.date = item.date
  editForm.images = []
  showModal.value = true
  nextTick(() => {
    editQuill = new Quill(editEditor.value, { theme: 'snow', modules: { toolbar: [['bold', 'italic'], ['link']] } })
    editQuill.root.innerHTML = editForm.text
    editQuill.on('text-change', () => editForm.text = editQuill.root.innerHTML)
  })
}

function onEditFileChange(e) {
  editForm.images = Array.from(e.target.files)
}

function updateNews() {
  // синхронизируем Quill с editForm
  if (editQuill) editForm.text = editQuill.root.innerHTML

  const data = new FormData()
  data.append('name', editForm.name)
  data.append('text', editForm.text)
  data.append('date', editForm.date)
  editForm.images.forEach(file => data.append('images[]', file)) // добавляем все выбранные файлы

  router.post(`/admin/news/${editingId}`, data, {
    headers: { 'X-HTTP-Method-Override': 'PUT' },
    onSuccess: () => {
      closeModal()
      router.get('/admin')
    },
    onError: errors => console.log(errors)
  })
}
function deleteImage(imageId) {
  router.delete(route('admin.news_images.destroy', imageId), {
    onSuccess: () => {
      // ничего не фильтруем, просто закрываем модалку или оставляем пустым
      // Inertia сделает редирект или обновление страницы
    },
    onError: (err) => console.log(err)
  })
}


function closeModal() {
  showModal.value = false
  editingId = null
  editForm.reset()
}
</script>
