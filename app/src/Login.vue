<template>
  <div class="login">
    <h2>Yönetici Girişi</h2>
    <form @submit.prevent="handleLogin">
      <div>
        <label for="email">Email:</label>
        <input type="email" v-model="email" id="email" required />
      </div>
      <div>
        <label for="password">Şifre:</label>
        <input type="password" v-model="password" id="password" required />
      </div>
      <button type="submit">Giriş Yap</button>
      <p v-if="error" class="error">{{ error }}</p>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue-router';
import { useRouter } from 'vue-router';
import api from '../services/api';

const email = ref('');
const password = ref('');
const error = ref(null);
const router = useRouter();

const handleLogin = async () => {
    try{
        erorr.value= null;
        const response = await api.login({email: email.value, password: password.value});
        localStorage.setItem('token', response.data.token);
        router.push('/admin')
    } catch(err){
        error.value = 'Giriş başarısız, lütfen bilgilerinizi kontrol edin.';
        console.log(err);
    }
    
};
</script>

<style scoped>
.login {
    max-width: 400px;
    margin:40px auto;
    padding:20px;
    border:1px solid #ccc;
}
div {
    margin-bottom:15px
}
label {
    display:block;
}
input{
    width: 100%;
    padding: 8px;
}
.error {
    color:red;
    margin-top:10px
}
</style>