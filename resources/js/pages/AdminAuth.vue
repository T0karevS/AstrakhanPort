<template>
  <div class="max-w-sm mx-auto mt-20">
    <h1 class="text-xl mb-4">Введите пароль</h1>
    <form @submit.prevent="submit">
      <input
        type="password"
        v-model="password"
        placeholder="Пароль"
        class="border p-2 w-full mb-2"
      />
      <button class="bg-black text-white px-4 py-2 w-full">Войти</button>
    </form>
    <div v-if="errors.password" class="text-red-500 mt-2">{{ errors.password }}</div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { router, usePage } from '@inertiajs/vue3'

const password = ref('')
const errors = usePage().props.errors || {}

function submit() {
  router.post('/admin', { password: password.value }, { preserveScroll: true })
}
</script>