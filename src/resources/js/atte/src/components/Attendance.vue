<script setup>
import { onMounted, ref } from "vue";
import axios from "axios";

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
    const data = json.data.items;

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
</script>

<template>
    <table>
        <tr>
            <th>名前</th>
            <th>勤務開始</th>
            <th>勤務終了</th>
            <th>休憩時間</th>
            <th>勤務時間</th>
        </tr>
        <tr v-for="attendance in attendances" >
            <th>{{ attendance.user.name }}</th>
            <th>{{ attendance.start_time }}</th>
            <th>{{ attendance.end_time }}</th>
            <th>{{ attendance.bleakTime }}</th>
            <th>{{ attendance.workTime - attendance.bleakTime }}</th>
        </tr>
    </table>
</template>
