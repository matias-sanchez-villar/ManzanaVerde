<template>
    <div class="not-found">
        <h1>Página no encontrada</h1>
        <p>Lo sentimos, la página que estás buscando no existe.</p>
        <router-link to="/">Volver a la página de inicio</router-link>
    </div>
</template>

<script>
export default {
    name: 'NotFound'
};
</script>

<style scoped>
.not-found {
    text-align: center;
    margin-top: 50px;
}
</style>
