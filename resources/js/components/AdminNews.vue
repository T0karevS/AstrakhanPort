<template>
  <div class="p-4">
    <h1 class="text-2xl mb-4">Новости</h1>

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
        <div class="flex space-x-2 mt-2">
          <img
            v-for="img in item.images"
            :key="img.id"
            :src="`/${img.image_path}`"
            class="w-20 h-20 object-cover"
          />
        </div>
        <button @click="deleteNews(item.id)" class="text-red-500 mt-2">Удалить</button>
      </li>
    </ul>
  </div>
</template>

<script setup>
import { useForm, router } from '@inertiajs/vue3'
import { onMounted, ref } from 'vue'
import Quill from 'quill'
import 'quill/dist/quill.snow.css'

const editor = ref(null)
let quill

const props = defineProps(['news'])

const form = useForm({
  name: '',
  text: '',
  date: '',
  images: []
})

onMounted(() => {
  quill = new Quill(editor.value, {
    theme: 'snow',
    placeholder: '...',
    modules: {
      toolbar: [
        [{ header: [1, 2, 3, false] }], 
        ['bold', 'italic', 'underline'],
        [{ list: 'ordered' }, { list: 'bullet' }],
        ['link']
      ]
    }
  })


  quill.on('text-change', () => {
    form.text = quill.root.innerHTML
  })
})

function onFileChange(e) {
  form.images = Array.from(e.target.files)
}

function submit() {
  form.post(route('admin.news.store'), {
    forceFormData: true,
    onSuccess: () =>
      router.get(route('admin.dashboard'), { preserveState: true })
  })
}

function deleteNews(id) {
  router.delete(route('admin.news.destroy', id), {
    onSuccess: () =>
      router.get(route('admin.dashboard'), { preserveState: true })
  })
}
</script>
