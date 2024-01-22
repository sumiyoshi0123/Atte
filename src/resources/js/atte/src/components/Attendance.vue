<script setup>
import { onMounted, ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

const attendances = ref([
    {
        "id": 1,
        "user_id": 1,
        "date": "2023-11-28",
        "start_time": "10:00:00",
        "end_time": "20:00:00",
        "created_at": null,
        "updated_at": null,
        "user": {
            "id": 1,
            "name": "テスト一郎",
            "email": "test01@gmail.com",
            "email_verified_at": null,
            "created_at": null,
            "updated_at": null
        },
        "bleak": [
            {
                "id": 1,
                "work_id": 1,
                "start_time": "12:00:00",
                "end_time": "13:00:00",
                "created_at": null,
                "updated_at": null
            },
            {
                "id": 2,
                "work_id": 1,
                "start_time": "15:00:00",
                "end_time": "15:30:00",
                "created_at": null,
                "updated_at": null
            }
        ],

        "workTime": 0,

        "bleakTime": 0
    },
]);

onMounted(async () => {
    const json = await axios.get("http://localhost/api/attendance");
    const data = json.data.items.data;
    console.log(data)

    const workTime = data.map((attendance) => {
        const startDate = new Date(attendance.date + " " + attendance.start_time)
        const endDate = new Date(attendance.date + " " + attendance.end_time)

        attendance.workTime = (endDate - startDate) / 1000 / 3600
        //ミリ秒->秒->時間へ変換

        return attendance

    })
    attendances.value = workTime;

    const bleakTime = data.map((attendance) => {
        const total = attendance.bleak.length
        if (total > 1) {
            const bleakHours = attendance.bleak.map((bleak) => {
                const start = new Date(attendance.date + " " + bleak.start_time)
                const end = new Date(attendance.date + " " + bleak.end_time)
                return (end - start) / 1000 / 3600
            });
            const totalBleakHours = bleakHours.reduce((sum, bleakHour) => {
                return sum + bleakHour;
            }, 0);
                attendance.bleakTime = totalBleakHours;
        } else {
            for (const bleak of attendance.bleak) {
                const start = new Date(attendance.date + " " + bleak.start_time)
                const end = new Date(attendance.date + " " + bleak.end_time)

                attendance.bleakTime = (end - start) / 1000 / 3600
            }
        }
        return attendance
    })
    attendances.value = bleakTime;
});

//ログアウト機能
const router = useRouter();
const logout = async () => {
    localStorage.removeItem('token');
    router.push({ name: "login" });
}

// 値変更時に取得
function get() {

    console.log(document.getElementById("setDate").value);

}


</script>

<template>
    <header>
        <h1 class="header-logo">Atte</h1>
        <nav>
            <ul class="header-menu">
                <li class="header-menu__item">ホーム</li>
                <li class="header-menu__item">日付一覧</li>
                <li><button class="header-menu__item" @click="logout()">ログアウト</button></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="index">
            <form class="date">
                <input type="date" id="setDate" onchange="get()">
            </form>
            <table class="work-data">
                <tr class="work-data__title">
                    <th>名前</th>
                    <th>勤務開始</th>
                    <th>勤務終了</th>
                    <th>休憩時間</th>
                    <th>勤務時間</th>
                </tr>
                <tr class="work-data__value" v-for="attendance in attendances" >
                    <th>{{ attendance.user.name }}</th>
                    <th>{{ attendance.start_time }}</th>
                    <th>{{ attendance.end_time }}</th>
                    <th>{{ attendance.bleakTime }}</th>
                    <th>{{ attendance.workTime - attendance.bleakTime }}</th>
                    </tr>
            </table>
            <v-pagination
                v-model="page"
                length="5">
            </v-pagination>
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
    .index {
        padding-top: 30px;
        background-color: #F2F2F2;
    }
    .date {
        margin-bottom: 30px;
    }
    .work-data {
        width: 90%;
        margin: 0px auto;
        border-collapse: collapse;
        border-top: 1px solid;
    }
    .work-data__title {
        height: 70px;
    }
    .work-data__value {
        height: 70px;
        border-top: 1px solid;
    }
</style>