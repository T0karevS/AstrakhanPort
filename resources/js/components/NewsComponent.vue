<template>
   
    <div v-if="$page.props.news.length">
      <div class="cards_container">
        <div v-for="item in $page.props.news" :key="item.id" class="company_card">
        <div class="overlay"></div>
        <div class="innercard_s">
          <div class="card-info">
            <a :href="'news/'+item.id"><p class="news_text">{{ item.name }}</p></a>
            <p class="news_date">{{ item.date }}</p>
          </div>
        </div>
        
        <img :src="item.images[0]"></img>
      </div>
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