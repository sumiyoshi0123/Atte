<script setup>
import { ref } from "vue";
import axios from "axios";

const email = ref("");
const password = ref("");

const login = async () => {
    const json = await axios.post("http://localhost/api/login", {
        email: email.value,
        password: password.value
    });
    console.log(json.data.token);
}
</script>
<template>
    <label>e-mail</label>
    <input type="text" v-model="email" />
    <label>password</label>
    <input type="text" v-model="password" />
    <button @click="login()">Login</button>
</template>