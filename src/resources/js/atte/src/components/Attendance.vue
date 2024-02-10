<script setup>
import { onMounted, ref, watch } from "vue";
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

        "bleakTime": 0,

    },
]);

onMounted(async () => {
    const today = new Date(); //今日の日付を取得
    const yyyy = today.getFullYear();
    const mm = ("0" + (today.getMonth() + 1)).slice(-2); //0 + 月(1~12)の右から2文字を指定
    const dd = ("0" + today.getDate()).slice(-2);
    setDate.value = yyyy + "-" + mm + "-" + dd;

    fetchAttendances(); //attendancesの内容を書き換えて表示するメソッド
});

const fetchAttendances = async () => {
    const json = await axios.get("http://localhost/api/attendance", {
        params: {
            // ここにクエリパラメータを指定する
            setDate: setDate.value,
            page: page.value,
        }
    });
    const data = json.data.items.data;
    // console.log(data)

    const workTime = data.map((attendance) => {
        const startDate = new Date(attendance.date + " " + attendance.start_time)
        const endDate = new Date(attendance.date + " " + attendance.end_time)

        attendance.workTime = (endDate - startDate)
        //ミリ秒->秒->時間へ変換  / 1000 / 3600

        return attendance

    })
    attendances.value = workTime;

    const bleakTime = data.map((attendance) => {
        const total = attendance.bleak.length
        if (total > 1) {
            const bleakHours = attendance.bleak.map((bleak) => {
                const start = new Date(attendance.date + " " + bleak.start_time)
                const end = new Date(attendance.date + " " + bleak.end_time)
                return (end - start)
            });
            const totalBleakHours = bleakHours.reduce((sum, bleakHour) => {
                return sum + bleakHour;
            }, 0);
            attendance.bleakTime = totalBleakHours;
        } else {
            for (const bleak of attendance.bleak) {
                const start = new Date(attendance.date + " " + bleak.start_time)
                const end = new Date(attendance.date + " " + bleak.end_time)

                attendance.bleakTime = (end - start)
            }
        }

        return attendance
    })
    attendances.value = bleakTime;
};

//フォーマット
const formatTime = (time) => {
    const hours = ("0" + Math.floor(time / 1000 / 60 / 60) % 24).slice(-2);
    const min = ("0" + Math.floor(time / 1000 / 60) % 60).slice(-2);
    const sec = ("0" + Math.floor(time / 1000) % 60).slice(-2);
    const format = hours + ":" + min + ":" + sec;
    return format
};


//日付を表示
const setDate = ref(''); //stateに空の値を設定

//日付を変える処理
const workDay = new Date();
//1日前にする
const prev = async () => {
    workDay.setDate(workDay.getDate() - 1);
    const yyyy = workDay.getFullYear();
    const mm = ("0" + (workDay.getMonth() + 1)).slice(-2);
    const dd = ("0" + workDay.getDate()).slice(-2);
    setDate.value = yyyy + "-" + mm + "-" + dd;
}
//1日後にする
const next = async () => {
    workDay.setDate(workDay.getDate() + 1);
    const yyyy = workDay.getFullYear();
    const mm = ("0" + (workDay.getMonth() + 1)).slice(-2);
    const dd = ("0" + workDay.getDate()).slice(-2);
    setDate.value = yyyy + "-" + mm + "-" + dd;
}

watch(setDate, (newSetDate) => {
    fetchAttendances(newSetDate);
});


const router = useRouter();

//日付一覧ボタンを押すとstamp.vueへ移動
const home = async () => {
    router.push({ name: "stamp" });
}

//ログアウト機能
const logout = async () => {
    localStorage.removeItem('token');
    router.push({ name: "login" });
}

//pagination処理
const page = ref(1); //現在のページを表示する(1ページ目)

</script>

<template>
    <header>
        <h1 class="header-logo">Atte</h1>
        <nav>
            <ul class="header-menu">
                <li><button class="header-menu__item" @click="home()">ホーム</button></li>
                <li class="header-menu__item">日付一覧</li>
                <li><button class="header-menu__item" @click="logout()">ログアウト</button></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="index">
            <div class="date">
                <p class="work-day">
                    <button class="prev" @click="prev()"> ＜ </button>
                    {{ setDate }}
                    <button class="next" @click="next()"> ＞ </button>
                </p>
            </div>
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
                    <th>{{ formatTime(attendance.bleakTime) }}</th>
                    <th>{{ formatTime(attendance.workTime - attendance.bleakTime) }}</th>
                    </tr>
            </table>
            <v-pagination
                v-model="page"
                length="5"
                @click="fetchAttendances">
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
    .get-date {
        padding-left: 10px;
    }
    .work-day {
        margin-top: 20px;
        font-size: 20px;
    }
    .prev {
        margin-right: 25px;
        width: 40px;
        height: 30px;
        border: 1px solid blue;
        color: blue;
        background-color: white;
    }
    .next {
        margin-left: 25px;
        width: 40px;
        height: 30px;
        border: 1px solid blue;
        color: blue;
        background-color: white;
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