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
    const token = "1|Fe8kOZkab0IPH9wC0COUZBBhbZy9V8P4ihYnlyJR";
    axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;
    localStorage.setItem("token", token);
    router.push({ name: "stamp" });
}

</script>

<template>
    <header>
            <h1 class="header-logo">Atte</h1>
            <nav>
                <ul class="header-menu">
                    <li class="header-menu__item">ホーム</li>
                    <li class="header-menu__item">日付一覧</li>
                    <li class="header-menu__item">ログアウト</li>
                </ul>
            </nav>
        </header>
        <main>
            <div class="stamp">
                <div class="message">さんお疲れ様です！</div>
                <div class="stamp-items">
                    <div class="stamp-item__1">勤務開始</div>
                    <div class="stamp-item__2">勤務終了</div>
                    <div class="stamp-item__3">休憩開始</div>
                    <div class="stamp-item__4">休憩終了</div>
                </div>
            </div>
        </main>
</template>

<style>
    header {
        display: flex;
        justify-content: space-between;
    }
    .header-logo {
        margin-left: 40px;
    }
    .header-menu {
        display: flex;
        list-style: none;
    }
    .header-menu__item{
        margin-top: 20px;
        margin-right: 40px;
        font-weight: bold;
    }
    .stamp {
        height: 600px;
        padding-top: 30px;
        background-color: #F2F2F2;
    }
    .message {
        margin-bottom: 30px;
    }
    .stamp-items {
        display: grid;
        grid-template-rows: 200px 50px 200px;
        grid-template-columns: 4fr 1fr 4fr;
    }
    .stamp-item {
        width: 500px;
        height: 200px;
        text-align: center;
    }
    .stamp-item__1 {
        grid-column: 1/2;
        grid-row: 1/2;
    }
    .stamp-item__2 {
        grid-column: 3/4;
        grid-row: 1/2;
    }
    .stamp-item__3 {
        grid-column: 1/2;
        grid-row: 3/4;
    }
    .stamp-item__4 {
        grid-column: 3/4;
        grid-row: 3/4;
    }
</style>