<template>

  <div class="docs_container" v-if="$page.props.initialSection === 'documents'">
    <template v-if="Object.keys($page.props.documentsData).length">
      <div v-if="$page.props.initialSection === 'documents'">
        <div class="docs_category" v-for="(docs, category) in $page.props.documentsData" :key="category">
          <h3>{{ category }}</h3>
          <ul class="document-list">
            <li v-for="doc in docs" :key="doc.id" class="document-item">
              <i :class="['fas', getFileIcon(doc.doc_link), 'fa-2x']"></i>
              <a :href="`/storage/${doc.doc_link}`" target="_blank" class="document-link">
                {{ doc.doc_name }}
              </a>
              <!-- <span class="file-size">({{ getFileSize(doc.doc_link) }})</span> -->
            </li>
          </ul>
        </div>
      </div>
    </template>
    <div v-else>
      Нет документов для отображения
    </div>
  </div>
</template>
<script>
import { defineProps, computed } from 'vue';

export default {
  props: {
    documentsData: {
      type: Object,
      default: () => ({})
    }
  },
  
  setup(props) {
    const groupedDocuments = computed(() => {
      return props.documentsData || {};
    });

    return { groupedDocuments };
  },

  methods: {
    getFileIcon(filePath) {
      const extension = filePath.split('.').pop().toLowerCase();

      const icons = {
        pdf: 'fa-file-pdf',
        doc: 'fa-file-word',
        docx: 'fa-file-word',
        xls: 'fa-file-excel',
        xlsx: 'fa-file-excel',
        ppt: 'fa-file-powerpoint',
        pptx: 'fa-file-powerpoint',
        jpg: 'fa-file-image',
        jpeg: 'fa-file-image',
        png: 'fa-file-image',
        gif: 'fa-file-image',
        zip: 'fa-file-archive',
        rar: 'fa-file-archive',
        txt: 'fa-file-alt',
        csv: 'fa-file-csv',
      };

      return icons[extension] || 'fa-file';
    },
    // getFileSize(filePath) {
    //   const fullPath = filePath;
      
    //   try {
    //     const sizeInBytes = require('fs').statSync(fullPath).size;
        
    //     if (sizeInBytes > 1024 * 1024) {
    //       return (sizeInBytes / (1024 * 1024)).toFixed(1) + ' MB';
    //     } else if (sizeInBytes > 1024) {
    //       return (sizeInBytes / 1024).toFixed(1) + ' KB';
    //     }
    //     return sizeInBytes + ' B';
    //   } catch {
    //     return 'N/A';
    //   }
    // }
  }
}
</script>
<style scoped>
.negr {
  height: 400px;
}
</style>