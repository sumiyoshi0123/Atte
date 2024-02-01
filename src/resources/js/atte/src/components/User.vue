<script setup>
defineProps(['name'])
</script>

<template>
    <p class="name">{{ name }}</p>
</template>

<style>
.name {
    display: inline-block;
}
</style>