<script setup>
import { ref, computed } from 'vue';

// Тарифы и настройки калькулятора
const rates = {
  grain_transshipment: {
    name: 'Перевалка зерна',
    rate: 500, // руб/тонна
    unit: 'тонна',
    additionalParams: {
      storage: {
        rate: 50, // руб/тонна/день
        label: 'Хранение (руб/тонна/день)'
      }
    }
  },
  container_export: {
    name: 'Контейнеры (экспорт)',
    rate: 15000, // руб/контейнер
    unit: 'контейнер',
    additionalParams: {}
  },
  container_domestic: {
    name: 'Контейнеры (внутрироссийские)',
    rate: 12000, // руб/контейнер
    unit: 'контейнер',
    additionalParams: {}
  },
  hazardous: {
    name: 'Опасные грузы',
    rate: 20000, // руб/контейнер
    unit: 'контейнер',
    additionalParams: {
      hazardClass: {
        label: 'Класс опасности',
        options: {
          1: '1 класс (+20%)',
          2: '2 класс (+15%)',
          3: '3 класс (+10%)',
          4: '4 класс (+5%)',
        },
        multipliers: {
          1: 1.2,
          2: 1.15,
          3: 1.1,
          4: 1.05,
        }
      }
    }
  }
};

// Реактивные данные формы
const form = ref({
  serviceType: 'grain_transshipment',
  quantity: 1,
  additionalParams: {
    storageDays: 0,
    hazardClass: null
  }
});

// Вычисляем итоговую стоимость
const total = computed(() => {
  const service = rates[form.value.serviceType];
  if (!service) return 0;
  
  let baseCost = service.rate * form.value.quantity;
  
  // Дополнительные расчеты для специфичных услуг
  if (form.value.serviceType === 'grain_transshipment') {
    baseCost += form.value.additionalParams.storageDays * service.additionalParams.storage.rate * form.value.quantity;
  }
  
  if (form.value.serviceType === 'hazardous' && form.value.additionalParams.hazardClass) {
    const multiplier = service.additionalParams.hazardClass.multipliers[form.value.additionalParams.hazardClass];
    baseCost *= multiplier;
  }
  
  return Math.round(baseCost);
});

// Текущий выбранный сервис
const currentService = computed(() => rates[form.value.serviceType]);
</script>

<template>
  <div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6">Калькулятор логистических услуг</h1>
    
    <div class="space-y-4">
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Тип услуги</label>
        <select 
          v-model="form.serviceType"
          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
        >
          <option v-for="(service, key) in rates" :value="key" :key="key">
            {{ service.name }}
          </option>
        </select>
      </div>
      
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">
          Количество ({{ currentService.unit }})
        </label>
        <input
          v-model.number="form.quantity"
          type="number"
          min="0.1"
          step="0.1"
          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
        >
      </div>
      
      <!-- Дополнительные параметры для перевалки зерна -->
      <div v-if="form.serviceType === 'grain_transshipment'">
        <label class="block text-sm font-medium text-gray-700 mb-1">
          {{ currentService.additionalParams.storage.label }}
        </label>
        <input
          v-model.number="form.additionalParams.storageDays"
          type="number"
          min="0"
          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
        >
      </div>
      
      <!-- Дополнительные параметры для опасных грузов -->
      <div v-if="form.serviceType === 'hazardous'">
        <label class="block text-sm font-medium text-gray-700 mb-1">
          {{ currentService.additionalParams.hazardClass.label }}
        </label>
        <select
          v-model="form.additionalParams.hazardClass"
          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
        >
          <option :value="null">Не выбрано</option>
          <option v-for="(label, key) in currentService.additionalParams.hazardClass.options" :value="key" :key="key">
            {{ label }}
          </option>
        </select>
      </div>
      
      <div class="pt-4 border-t border-gray-200">
        <div class="flex justify-between items-center">
          <span class="text-lg font-medium">Итого:</span>
          <span class="text-2xl font-bold">{{ total }} руб.</span>
        </div>
      </div>
    </div>
  </div>
</template>