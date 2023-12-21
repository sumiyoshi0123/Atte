<template>
    <div id ="app">
        <router-view />
    </div>
    <footer>
        <p class="footer"><small>Atte, inc.</small></p>
    </footer>
</template>

<script>

export default {
    components: {}
};
</script>

<style>
#app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
    /* margin-top: 60px; */
}
.footer {
    text-align: center;
    font-weight: bold;
    font-size: 15px;
}
</style>
