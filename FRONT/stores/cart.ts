// stores/cart.ts

import { defineStore } from 'pinia';

interface Room {
    id: number;
    name: string;
    description?: string;
    price: number;
    disponibles: number;
    image_paths?: string[];
}

interface CartState {
    items: Room[];
}

export const useCartStore = defineStore('cart', {
    state: (): CartState => ({
        items: [],
    }),
    actions: {
        addToCart(room: Room) {
            this.items.push(room);
        },
        removeFromCart(roomId: number) {
            this.items = this.items.filter(item => item.id !== roomId);
        },
        clearCart() {
            this.items = [];
        },
    },
});
