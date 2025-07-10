<template>
    <div>dasd</div>
    <div v-if="$page.props.news.length">
      <div v-for="item in $page.props.news" :key="item.id" class="news-item">
        <h2>{{ item.name }}</h2>
        <p>Дата: {{ item.date }}</p>
        <div v-html="item.text"></div>
      </div>
    </div>
<div v-else>
    Нет новостей
</div>
    
</template>
<script>
export default {
  props: {
    news: {
      type: Array,
      required: true,
      default: () => []
    }
  }
}
</script>