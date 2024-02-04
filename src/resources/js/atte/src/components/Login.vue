<script setup>
import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

const email = ref("");
const password = ref("");
const router = useRouter();

const login = async () => {
    const json = await axios.post("http://localhost/api/login", {
        email: email.value,
        password: password.value
    });
    console.log(json.data.token);
    const token = json.data.token;
    axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;
    localStorage.setItem("token", token);
    router.push({ name: "stamp"}); //ログイン後はStamp.vueへ移動
}
</script>

<template>
    <header>
        <h1 class="header-logo">Atte</h1>
    </header>
    <main>
        <div class="login-form">
            <h3 class="login-form__title">ログイン</h3>
            <div class="login-form__item">
                <input class="email" type="text" v-model="email" placeholder="  メールアドレス"/>
                <input class="pass" type="text" v-model="password" placeholder="  パスワード"/>
            </div>
            <button class="login-form__button" @click="login()">ログイン</button>
            <p class="guide">アカウントをお持ちでない方はこちらから</p>
            <a class="link" href="/register">会員登録</a>
        </div>
    </main>
</template>

<style>
    .header-logo {
        text-align: left;
        margin-left: 40px;
    }
    .login-form {
        height: 500px;
        padding-top: 25px;
        background-color: #F2F2F2;
    }
    .login-form__title {
        margin-bottom: 30px;
    }
    .login-form__item {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .email, .pass {
        width: 300px;
        height: 40px;
        margin-bottom: 20px;
        border: solid 1px;
        font-size: 14px;
    }
    .login-form__button {
        width: 310px;
        height: 40px;
        color: white;
        background-color: blue;
        font-size: 14px;
    }
    .guide {
        margin-top: 30px;
        font-size: 12px;
    }
    .link {
        font-size: 12px;
    }
</style>