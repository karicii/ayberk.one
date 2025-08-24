<template>
    <div class="home">
        <h1>Blog Yazıları</h1>
        <div v-if="loading">Yükleniyor...</div>
        <div v-if="error" class="error">{{ error }}</div>
    <ul v-if="posts.lenght">
        <li v-for="post in posts" :key="post.slug">
        <router-link :to="{ name: 'PostDetail', params: { slug: post.slug }}">
        <h2>{{ post.title }}</h2>
        <p>{{ new Date(post.published_at).toLocaleDateString() }}</p>    
        </router-link>
        </li>
    </ul>
    <div v-else>
        Henüz gösterilecek yazı yok.
    </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import api from '../services/api';

const posts = ref([]);
const loading = ref(true);
const error = ref(null);

onMounted(async ()=> {
    try {
        const response = await api.getPosts();
        posts.value = response.data;
    } catch (err) {
        error.value = 'Yazılar yüklenirken bir hata oluştu.';
        console.error(err);
    } finally {
        loading.value = false;
    }
});
</script>

<style scoped>
    ul {
        list-style:none;
        padding:0;
    }
    li a {
        display: block;
        padding: 15px;
        border: 1px solid #ddd;
        margin-bottom:10px;
        text-decoration:none;
        color:#333;
    }
    li a:hover {
        background-color:#f9f9f9;
    }
    .error {
        color:red;
    }
</style>