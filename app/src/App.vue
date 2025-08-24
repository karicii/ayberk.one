<template>
<div id="app">
<nav>
<router-link to="/">Anasayfa</router-link> |
<rouer-link v-if="!isLoggedIn" to="/login">Giriş Yap</rouer-link>
<router-link v-if="isLoggedIn" to="/admin">Yönetim Paneli</router-link>
<a href="#" v-if="isLoggedIn" @click.prevent="logout">Çıkış Yap</a>
</nav>
<router-view />
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

<style> 
nav {
  padding: 20px;
  background-color: #f2f2f2;
  text-align:center;
}
nav a {
  margin: 0 10px;
  text-decoration:none;
  color:#333;
  font-weight: bold;
}
</style>