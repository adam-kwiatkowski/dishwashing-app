import {reactive} from "vue";

export const useSinkStore = reactive({
    chosen: [],
    addItem(item) {
        const existingItem = this.chosen.find(i => i.id === item.id);
        if (!existingItem) {
            this.chosen.push(item);
        }
    },
    removeItem(item) {
      this.chosen.splice(this.chosen.indexOf(item), 1);
    }
});
