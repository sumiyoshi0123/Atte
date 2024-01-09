<script setup>
import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

//出勤登録
const start = ref({
    start: new Date()
});

const addWork = async() => {
    const json = await axios.post('https://localhost/api/stamp', {
        addWork: start.value
    });
    alert('${start.value} 出勤完了')
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
                    <button class="stamp-item__1" @click="addWork">勤務開始</button>
                    <button class="stamp-item__2" @click="">勤務終了</button>
                    <button class="stamp-item__3" @click="">休憩開始</button>
                    <button class="stamp-item__4" @click="">休憩終了</button>
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