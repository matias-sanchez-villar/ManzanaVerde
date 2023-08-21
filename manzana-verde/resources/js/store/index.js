import { createStore } from "vuex";

export default createStore({
  state : {
    orders: {
      user_id: "",
      items: []
    }
  },

  mutations : {
    addToCart(state, product) {
      state.orders.items.push(product);
    },
    setUserId(state, user_id) {
      if (!state.orders.userId.length != 0) {
        state.orders.user_id = user_id;
      }
    },
    clearCart(state) {
      state.orders.items = [];
    },
    clearUser(state) {
      state.orders.user_id = "";
    }
  },

  getters : {
    cartItems: state => state.orders.items,
    cartTotalItems: state => {
      return state.orders.items.reduce((total, item) => total + item.quantity, 0);
    },
    idUser: state => state.orders.user_id
  },

  actions : {
    setUserId({ commit }, user_id) {
      commit('setUserId', user_id);
    },

    addToCart({ commit, state }, { food_item_id, name, quantity }) {
      const existingItem = state.orders.items.find(item => item.food_item_id === food_item_id);

      if (existingItem) {
        existingItem.quantity += quantity;
      } else {
        const newItem = { food_item_id, name, quantity };
        commit('addToCart', newItem);
      }
    },
    clearCart({ commit }) {
      commit('clearCart');
    },
    clearUser({ commit }) {
      commit('clearUser');
    },
    setUserAndCart({ commit }, { orders }) {
      commit('setUserId', orders.user_id);
      commit('addToCart', orders.items);
    }
  }
});