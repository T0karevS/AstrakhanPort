import { ref } from 'vue'
export const showModal = ref(false)
export const modalProps = ref({}) 

export function openModal(props = {}) {
  modalProps.value = props
  showModal.value = true
  document.documentElement.style.overflow = 'hidden'
}

export function closeModal() {
  showModal.value = false
  document.documentElement.style.overflow = ''
}