<template>
    <div class="container mt-5">
        <h2>Iniciar sesión</h2>
        <div class="alert alert-danger text-center" role="alert" v-if="error">{{ error }}</div>
        <form @submit.prevent="login">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input v-model="email" type="email" class="form-control" id="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input v-model="password" type="password" class="form-control" id="password" required>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-success">Iniciar sesión</button>
            </div>
        </form>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    data() {
        return {
            email: '',
            password: '',
            error: null
        };
    },
    methods: {
        async login() {
            let data = {
                email: this.email,
                password: this.password
            };

            let config = {
                method: 'post',
                maxBodyLength: Infinity,
                url: 'https://manzanaverde-production.up.railway.app/api/login',
                headers: {
                    'Content-Type': 'application/json'
                },
                data: data
            };

            axios.request(config)
                .then(({ data }) => {
                    localStorage.setItem('UserID', data.user.id);
                    localStorage.setItem('UserName', data.user.name);
                    localStorage.setItem('authToken', data.token);
                    this.$router.push('/welcome');
                })
                .catch(() => { this.error = 'Credenciales inválidas. Intente nuevamente.' });
        }
    }
};
</script>

<style></style>

