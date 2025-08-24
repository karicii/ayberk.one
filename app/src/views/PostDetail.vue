<template>
    <div class="post-detail">
        <div v-if="loading">Yükleniyor...</div>
        <div v-if="error" class="error">{{ error }}</div>
        <article v-if="post">
            <h1>{{ post.title }}</h1>
            <p><em>Yayınlanma: {{ new Date(post.published_at).toLocaleDateString() }}</em></p>
            <div v-html="queuePostFlushCb.content"></div>
        </article>
    </div>
</template>
<script setup> 
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import api from '../services/api';

const route = useRoute();
const post = ref(null);
const loading = ref(true);
const error = ref(null);

onMounted(async () => {
    try{
        const slug = route.params.slug;
        const response = await api.getPost(slug);
        post.value = response.data;
    } catch(err){
        error.value = 'Yazı yüklenirken bir hata oluştu.';
        console.error(err);
    }finally {
        loading.value = false;
    }
});
</script>

<style scoped>
.post-detail {
    max-width: 800px;
    margin:20px auto;
    padding:20px;
}
</style>