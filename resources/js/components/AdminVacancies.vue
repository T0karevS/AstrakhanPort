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
                <div class="flex gap-2">
                    <button @click="openEditModal(vacancy)" class="text-blue-500">Редактировать</button>
                    <button @click="deleteVacancy(vacancy.id)" class="text-red-500">Удалить</button>
                </div>
            </li>
        </ul>
        <p v-else class="text-gray-500">Вакансий нет</p>

        <!-- Модалка редактирования -->
        <div v-if="editModalOpen" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
            <div class="bg-white p-6 w-96 rounded shadow">
                <h2 class="text-xl mb-4">Редактировать вакансию</h2>
                <form @submit.prevent="submitEdit" class="space-y-2">
                    <span>Название вакансии</span>
                    <input v-model="editForm.name" type="text" placeholder="Название вакансии"
                        class="border p-2 w-full" />
                    <span>Зарплата</span><input v-model="editForm.salary" type="text" placeholder="Зарплата"
                        class="border p-2 w-full" />
                        <span>Опыт</span>
                    <input v-model="editForm.experience" type="text" placeholder="Опыт" class="border p-2 w-full" />
                    <span>Описание</span><textarea v-model="editForm.description" placeholder="Описание"
                        class="border p-2 w-full"></textarea>
                    <span>Тип занятости</span><input v-model="editForm.employment" type="text"
                        placeholder="Тип занятости" class="border p-2 w-full" />
                    <div class="flex justify-end gap-2 mt-2">
                        <button type="button" @click="closeEditModal" class="px-4 py-2 border">Отмена</button>
                        <button class="bg-black text-white px-4 py-2">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { useForm, router } from '@inertiajs/vue3'
import { ref } from 'vue'

const props = defineProps(['vacancies'])

// Форма добавления
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

// Удаление вакансии
function deleteVacancy(id) {
    router.delete(route('admin.vacancies.destroy', id), {
        onSuccess: () => {
            window.location.reload()
        },
    })
}

// Модалка редактирования
let editModalOpen = ref(false)
let editForm = useForm({
    id: null,
    name: '',
    salary: '',
    experience: '',
    description: '',
    employment: '',
})

function openEditModal(vacancy) {
    editForm.id = vacancy.id
    editForm.name = vacancy.name
    editForm.salary = vacancy.salary
    editForm.experience = vacancy.experience
    editForm.description = vacancy.description
    editForm.employment = vacancy.employment
    editModalOpen.value = true
}

function closeEditModal() {
    editModalOpen.value = false
    editForm.reset()
}

function submitEdit() {
    router.put(route('admin.vacancies.update', editForm.id), editForm, {
        onSuccess: () => {
            closeEditModal()
            window.location.reload()
        },
    })
}
</script>
