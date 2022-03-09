import { reactive } from "vue";

export const store = reactive({
    basket: [],
    addUtensil(utensil) {
        this.basket.push(utensil);
    },
    removeUtensil(utensil) {
        this.basket.splice(this.basket.indexOf(utensil), 1);
    },
});
