<template>
  <div class="vacancy_contact">
    <div class="vacancy_contact_inner">
      <button class="Ybtn">Отправить резюме</button>
      <div class="vacancy_contact_name">
        <p class="contactsl1">Контактное лицо</p>
        <p class="contactsl2">Капустин Сергей Павлович</p>
      </div>
      <div class="vacancy_contact_name">
        <p class="contactsl1">Телефон</p>
        <p class="contactsl2">+7 (8512) 44-28-88</p>
      </div>
    </div>
    <p class="vacancy_text">Мы рады видеть в команде инициативных и вовлеченных сотрудников, готовых решать сложные
      задачи и реализовывать масштабные проекты</p>
  </div>
  <div class="vacancy" v-if="$page.props.initialSection === 'vacancy'">

    <div v-for="vacancy in $page.props.vacanciesData" :key="vacancy.id" class="vacancy-card">
      <div id="extend_vacancy" @click="toggleRotate" class="vacancy_activeblock">
        <div  class="vacancy-card-upper">
          <h3>{{ vacancy.name }}</h3>
          <div class="vacancy-inner-container">
            <h3>{{ vacancy.salary }}</h3>
            <span id="extend_vacancy" :style="{ transform: isRotated ? 'rotate(45deg)' : 'rotate(0)' }"
              class="rotate-btn">
              +</span>
          </div>
        </div>
        <div class="vacancy-meta">
        
        <span>Опыт: {{ vacancy.experience }}</span>
        <span style="margin: 0 5px;"> — </span>
        <span>Тип занятости: {{ vacancy.employment }}</span>
      </div>
    </div>
      <div class="vacancy-description">
        <div class="vacancy-description-text" v-html="vacancy.description"></div>
        <button class="Ybtn" @click="applyForVacancy(vacancy.id)">Отправить резюме</button>
      </div>


    </div>
  </div>
</template>
<script>

export default {
  props: {
    initialSection: String, // Получаем из Inertia
    vacanciesData: Object,
  },
  data() {
    return {
      isRotated: false
    }
  },
  methods: {
    toggleRotate() {
      this.isRotated = !this.isRotated;
      const desc = document.querySelector('.vacancy-description');
      if (desc) desc.style.display = this.isRotated ? 'block' : 'none';

    }
  }

}


</script>