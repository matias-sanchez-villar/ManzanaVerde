<template>
    <div>
        <h1 class="m-4">Lista de Alimentos</h1>
        <div class="d-flex justify-content-center m-5" v-if="foods.length == 0">
            <div class="spinner-border text-success" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <div class="alert alert-danger text-center" role="alert" v-if="error">{{ error }}</div>
        <div class="row m-4 justify-content-center">
            <div class="col-md-4 mb-3" v-for="food in foods" :key="food.id">
                <div class="card" style="height: 100%;">
                    <div class="d-flex flex-column justify-content-between h-100">
                        <img :src="food.photo" class="card-img-top" alt="Foto del alimento">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title">{{ food.name }}</h5>
                            <p class="card-text">{{ food.description }}</p>
                            <button class="btn btn-success" @click="addToCart(food)">+ Agregar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import store from '@/store';

export default {
    data() {
        return {
            foods: [],
            error: null
        };
    },
    methods: {
        addToCart(food) {
            const newItem = { food_item_id: food.id, name: food.name, quantity: 1 };
            store.dispatch('addToCart', newItem);
        }
    },
    created() {
        axios.get('https://127.0.0.1:8000/api/foods', {
            headers: {
                'Authorization': `Bearer ${localStorage.getItem("authToken")}`
            }
        })
            .then(response => {
                this.foods = response.data;
            })
            .catch(() => { error = "Error al listar los alimentos, intente nuevamente" });
    }
};
</script>

<style></style>

