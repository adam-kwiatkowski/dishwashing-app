import {reactive} from "vue";

export const useBasketStore = reactive({
  basket: [],
  addItem(item) {
    const existingItem = this.basket.find(i => i.id === item.id);
    if (!existingItem) {
      this.basket.push(item);
    }
  },
  removeItem(item) {
    this.basket.splice(this.basket.indexOf(item), 1);
  },
});
