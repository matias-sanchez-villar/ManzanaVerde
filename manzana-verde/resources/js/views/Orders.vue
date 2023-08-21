<template>
    <div>
        <h1>Mis Órdenes</h1>
        <div class="d-flex justify-content-center m-5" v-if="spinner">
            <div class="spinner-border text-success" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <div class="alert alert-danger text-center" role="alert" v-if="error">{{ error }}</div>
        <div class="alert alert-success text-center" role="alert" v-if="success">{{ success }}</div>
        <div v-if="cartItems.length > 0">
            <div class="container">
                <table class="table table-hover">
                    <thead>
                        <tr class="text-center">
                            <th scope="col" class="text-center">Nombre producto</th>
                            <th scope="col">Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in cartItems" class="text-center">
                            <td>{{ item.name }}</td>
                            <td>{{ item.quantity }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-success mx-4" @click="adquirirOrden">Adquirir</button>
                </div>
            </div>
        </div>
        <p v-else>Sin órdenes pendientes</p>
    </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
import axios from 'axios';

export default {
    data() {
        return {
            success: null,
            error: null,
            spinner: false
        };
    },
    computed: {
        ...mapGetters(['cartItems'])
    },
    methods: {
        ...mapActions(['clearCart']),
        async adquirirOrden() {
            this.spinner = true;
            const data = {
                user_id: localStorage.getItem("UserID"),
                items: this.cartItems
            };

            let config = {
                method: 'post',
                maxBodyLength: Infinity,
                url: 'https://manzanaverde-production.up.railway.app/api/orders',
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem("authToken")}`,
                    'Content-Type': 'application/json'
                },
                data: data
            };

            axios.request(config)
                .then((response) => {
                    this.clearCart();
                    this.success = "Alimentos aquiridos con exito !"
                })
                .catch(() => { this.error = "Error al adquirir los alimentos, intente nuevamente" });
        }
    }
};
</script>

<style></style>
