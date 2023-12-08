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
        "updated_at": null
    },
]);

onMounted(async () => {
    const json = await axios.get("http://localhost/api/attendance");
    const data = json.data.items[0];
    attendances.value = data;
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
            <th>{{ attendance.name }}</th>
            <th>{{ attendance.start_time }}</th>
            <th>{{ attendance.end_time }}</th>
            <th>{{  }}</th>
            <th>{{  }}</th>
        </tr>
    </table>
</template>
