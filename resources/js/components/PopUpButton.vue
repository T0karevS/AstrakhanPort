<template>
  <Teleport to="body">
    <div class="modal-overlay" @click="closeByBackdrop">
      <div v-if="showToast" class="toast">
        Заявка отправлена!
      </div>
      <div class="modal-card" role="dialog" aria-modal="true" aria-label="Оставьте заявку" @click.stop>
        <button class="modal-close" @click="$emit('close')" aria-label="Закрыть">×</button>

        <h2 class="modal-title">Оставьте заявку</h2>

        <form @submit.prevent="submit" class="modal-form">
          <input v-model="form.name" class="input" placeholder="Имя" required />
          <input v-model="form.phone" class="input" type="tel" placeholder="Телефон"
            @input="form.phone = form.phone.replace(/[^0-9+()\-\s]/g, '')" required />
            <input v-model="form.topic" class="input" placeholder="Тема обращения" required />
          <textarea v-model="form.message" class="textarea" placeholder="Сообщение"></textarea>
          <div class="checkbobs-div">
            <input class="checkbobs" type="checkbox" required>
            <p class="checkbobs-text">Согласие на обработку персональных данных</p>

          </div>
          <button class="btnZ" type="submit">Отправить</button>
        </form>
      </div>
    </div>
  </Teleport>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue'
import { useForm } from '@inertiajs/vue3'

defineProps(['props']);

const emit = defineEmits(['close'])

const form = useForm({
  name: '',
  phone: '',
  topic: '',
  message: '',
})

const showToast = ref(false) // <-- добавь это

function submit() {
  form.post(route('contact.store'), {
    onSuccess: () => {
      form.reset()
      showToast.value = true
      setTimeout(() => (showToast.value = false), 3000)
    },
  })
}

function closeByBackdrop() {
  emit('close')
}

function onEsc(e) {
  if (e.key === 'Escape') emit('close')
}

onMounted(() => {
  document.documentElement.style.overflow = 'hidden'
  window.addEventListener('keydown', onEsc)
})

onBeforeUnmount(() => {
  document.documentElement.style.overflow = ''
  window.removeEventListener('keydown', onEsc)
})
</script>

<style scoped>
.checkbobs-div {
  display: flex;
  gap: 20px;
}

/* полупрозрачный фон + блюр */
.modal-overlay {
  position: fixed;
  inset: 0;
  background: rgba(0, 0, 0, 0.25);
  /* затемнение */
  backdrop-filter: blur(4px);
  /* ~20% визуального блюра */
  -webkit-backdrop-filter: blur(4px);
  display: grid;
  place-items: center;
  z-index: 9999;
}

/* карточка модала */
.modal-card {
  width: min(560px, calc(100vw - 32px));
  background: #fff;
  border-radius: 16px;
  box-shadow: 0 20px 50px rgba(0, 0, 0, 0.25);
  padding: 24px 24px 20px;
  position: relative;
}

/* крестик */
.modal-close {
  position: absolute;
  top: 10px;
  right: 12px;
  width: 36px;
  height: 36px;
  border: none;
  background: transparent;
  font-size: 24px;
  line-height: 1;
  cursor: pointer;
  color: #888;
}

.modal-close:hover {
  color: #000;
}

/* заголовок */
.modal-title {
  margin: 0 0 16px 0;
  font-size: 20px;
  font-weight: 600;
}

/* форма */
.modal-form {
  display: grid;
  gap: 12px;
}

.input,
.textarea {
  width: 100%;
  border: 1px solid #e5e7eb;
  border-radius: 10px;
  padding: 10px 12px;
  font-size: 14px;
  outline: none;
  transition: border-color .15s ease, box-shadow .15s ease;
  background: #fff;
}

.input:focus,
.textarea:focus {
  border-color: #111827;
  box-shadow: 0 0 0 3px rgba(17, 24, 39, 0.08);
}

.textarea {
  min-height: 110px;
  resize: vertical;
}

.toast {
  position: fixed;
  top: 20px;
  right: 20px;
  background: #4caf50;
  color: white;
  padding: 12px 20px;
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
  z-index: 1000;
  animation: fadeInOut 3s forwards;
}

@keyframes fadeInOut {
  0% {
    opacity: 0;
    transform: translateY(-10px);
  }

  10%,
  90% {
    opacity: 1;
    transform: translateY(0);
  }

  100% {
    opacity: 0;
    transform: translateY(-10px);
  }
}
</style>