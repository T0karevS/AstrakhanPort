<template>
    <div class="p-4">
        <h1 class="text-2xl mb-4">Вакансии</h1>

        <!-- Форма добавления -->
        <form @submit.prevent="submit" class="mb-4 space-y-2">
            <input v-model="form.name" type="text" placeholder="Название вакансии" class="border p-2 w-full" />
            <input v-model="form.salary" type="text" placeholder="Зарплата" class="border p-2 w-full" />
            <input v-model="form.experience" type="text" placeholder="Опыт" class="border p-2 w-full" />
            <textarea v-model="form.description" placeholder="Описание" class="border p-2 w-full"></textarea>
            <input v-model="form.employment" type="text" placeholder="Тип занятости" class="border p-2 w-full" />
            <button class="bg-black text-white px-4 py-2">Добавить</button>
        </form>

        <!-- Список вакансий -->
        <ul v-if="props.vacancies && props.vacancies.length">
            <li v-for="vacancy in props.vacancies" :key="vacancy.id" class="flex justify-between items-center mb-2">
                <span>
                    {{ vacancy.name }} — {{ vacancy.salary }}, {{ vacancy.experience }}, {{ vacancy.employment }}
                    <p>{{ vacancy.description }}</p>
                </span>
                <button @click="deleteVacancy(vacancy.id)" class="text-red-500">
                    Удалить
                </button>
            </li>
        </ul>
        <p v-else class="text-gray-500">Вакансий нет</p>
    </div>
</template>

<script setup>
import { useForm, router } from '@inertiajs/vue3'

const props = defineProps(['vacancies'])

const form = useForm({
    name: '',
    salary: '',
    experience: '',
    description: '',
    employment: '',
})

function submit() {
  form.post(route('admin.vacancies.store'), {
    forceFormData: true,
    onSuccess: () => {
      form.reset()
      router.get(route('admin.dashboard'), { preserveState: true })
    },
  })
}

function deleteVacancy(id) {
    router.delete(route('admin.vacancies.destroy', id), {
        onSuccess: () => {
            window.location.reload()
        },
    })
}
</script>