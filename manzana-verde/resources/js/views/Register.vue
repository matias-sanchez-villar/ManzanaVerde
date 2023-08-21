<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ pageTitle }}</div>
                    <div class="alert alert-danger text-center" role="alert" v-if="error">{{ error }}</div>
                    <div class="alert alert-success text-center" role="alert" v-if="successMessage">{{ successMessage }}</div>
                    <div class="card-body">
                        <form @submit.prevent="register">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre</label>
                                <input v-model="name" type="text" class="form-control" id="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo electrónico</label>
                                <input v-model="email" type="email" class="form-control" id="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input v-model="password" type="password" class="form-control" id="password" required>
                            </div>
                            <div class="d-flex justify-content-cente">
                                <button type="submit" class="btn btn-success">Registrarse</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            name: '',
            email: '',
            password: '',
            error: '',
            successMessage: ''
        };
    },
    methods: {
        async register() {
            const data = {
                name: this.name,
                email: this.email,
                password: this.password
            };

            let config = {
                method: 'post',
                maxBodyLength: Infinity,
                url: 'https://manzanaverde-production.up.railway.app/api/register',
                headers: {
                    'Content-Type': 'application/json'
                },
                data: data
            };

            axios.request(config)
                .then((response) => {
                    this.successMessage = 'Registro exitoso. Redirigiendo a login en 10 segundos...';
                    setTimeout(() => {
                        this.$router.push('/login');
                    }, 10000)
                })
                .catch(() => {this.error = 'Error en el registro. Intente nuevamente.'});
        }
    },
    computed: {
        pageTitle() {
            return 'Register';
        }
    }
};
</script>

