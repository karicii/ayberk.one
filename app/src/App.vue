<template>
  <div id="app-wrapper">
    <header class="main-header">
      <div class="header-container">
        <router-link to="/" class="logo">ayberk.one</router-link>
        <nav class="main-nav">
          <router-link to="/">Yazılar</router-link>
          <router-link v-if="isLoggedIn" to="/admin">Yönetim Paneli</router-link>
          <a href="#" v-if="isLoggedIn" @click.prevent="logout" class="logout-button">Çıkış Yap</a>
          <router-link v-if="!isLoggedIn" to="/login" class="login-button">Giriş Yap</router-link>
        </nav>
      </div>
    </header>
    <main class="main-content">
      <router-view />
    </main>
  </div>
</template>

<script setup>
import { ref, watchEffect } from 'vue';
import { useRouter } from 'vue-router';
const router = useRouter();
const isLoggedIn = ref(!!localStorage.getItem('token'));
watchEffect(() => {
  isLoggedIn.value = !!localStorage.getItem('token');
});
const logout = () => {
  localStorage.removeItem('token');
  isLoggedIn.value = false;
  router.push('/login');
};
</script>