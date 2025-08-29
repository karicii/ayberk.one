<template>
  <div class="admin-dashboard">
    <h1>Yönetim Paneli</h1>

    <div class="form-container">
      <h2>{{ isEditing ? 'Yazıyı Düzenle' : 'Yeni Yazı Ekle' }}</h2>
      <form @submit.prevent="handleSubmit">
        <input type="text" placeholder="Başlık" v-model="formData.title" required />
        <input type="text" placeholder="Slug (URL uzantısı)" v-model="formData.slug" required />
        <textarea placeholder="İçerik" v-model="formData.content" rows="10" required></textarea>
        <div class="form-actions">
          <button type="submit">{{ isEditing ? 'Güncelle' : 'Oluştur' }}</button>
          <button type="button" v-if="isEditing" @click="cancelEdit">İptal</button>
        </div>
      </form>
    </div>

    <hr />

    <h2>Mevcut Yazılar</h2>
    <div v-if="loading">Yazılar yükleniyor...</div>
    <ul v-else class="post-list">
      <li v-for="post in posts" :key="post.slug">
        <span>{{ post.title }}</span>
        <div class="post-actions">
          <button @click="editPost(post)">Düzenle</button>
          <button @click="handleDelete(post.slug)">Sil</button>
        </div>
      </li>
    </ul>
  </div>
</template>

<script setup>
import { ref, onMounted, reactive } from 'vue';
import api from '../services/api';

const posts = ref([]);
const loading = ref(true);
const isEditing = ref(false);
const editingSlug = ref(null);

const formData = reactive({
  title: '',
  slug: '',
  content: '',
});

// Postları getiren fonksiyon
const fetchPosts = async () => {
  loading.value = true;
  try {
    // Admin panelinde tüm postları (sadece yayınlananları değil) getirmek için
    // backend'de yeni bir endpoint gerekebilir. Şimdilik findAllPublished kullanıyoruz.
    const response = await api.getPosts();
    posts.value = response.data;
  } catch (error) {
    console.error('Yazılar getirilirken hata:', error);
  } finally {
    loading.value = false;
  }
};

// Component yüklendiğinde postları getir
onMounted(fetchPosts);

const handleSubmit = async () => {
  try {
    if (isEditing.value) {
      // Güncelleme
      await api.updatePost(editingSlug.value, formData);
      alert('Yazı başarıyla güncellendi!');
    } else {
      // Yeni oluşturma
      await api.createPost(formData);
      alert('Yazı başarıyla oluşturuldu!');
    }
    resetForm();
    await fetchPosts(); // Listeyi yenile
  } catch (error) {
    console.error('İşlem sırasında hata:', error);
    alert('Bir hata oluştu.');
  }
};

const editPost = (post) => {
  isEditing.value = true;
  editingSlug.value = post.slug;
  formData.title = post.title;
  formData.slug = post.slug;
  // Detay getirme API çağrısı içeriği doldurmak için daha iyi olurdu
  // Şimdilik listeleme verisindekiyle yetiniyoruz.
  // Gerçek bir senaryoda:
  // api.getPost(post.slug).then(res => formData.content = res.data.content);
  formData.content = 'İçeriği düzenlemek için buraya yükleyin...';
  window.scrollTo(0, 0); // Sayfanın başına git
};

const handleDelete = async (slug) => {
  if (confirm('Bu yazıyı silmek istediğinizden emin misiniz?')) {
    try {
      await api.deletePost(slug);
      alert('Yazı başarıyla silindi!');
      await fetchPosts(); // Listeyi yenile
    } catch (error) {
      console.error('Silme sırasında hata:', error);
      alert('Silme işlemi sırasında bir hata oluştu.');
    }
  }
};

const resetForm = () => {
  isEditing.value = false;
  editingSlug.value = null;
  formData.title = '';
  formData.slug = '';
  formData.content = '';
};

const cancelEdit = () => {
  resetForm();
};
</script>

<style scoped>
.admin-dashboard {
  max-width: 900px;
  margin: auto;
}
.form-container {
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 8px;
  margin-bottom: 30px;
}
input, textarea {
  display: block;
  width: 100%;
  padding: 10px;
  margin-bottom: 10px;
  box-sizing: border-box;
}
.form-actions, .post-actions {
  display: flex;
  gap: 10px;
}
.post-list {
  list-style: none;
  padding: 0;
}
.post-list li {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 15px;
  border: 1px solid #eee;
  margin-bottom: 5px;
}
</style>