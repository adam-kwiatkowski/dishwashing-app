<template>
  <TransitionGroup>
    <UtensilCard
      v-for="utensil in store.chosen"
      :id="utensil.id"
      :key="utensil.id"
      :image_url="utensil.image_url"
      :name="utensil.name"
      :quantity="utensil.quantity"
      class="hover:bg-red-200 active:bg-red-300"
      @click="$emit('removed', utensil)"
    />
  </TransitionGroup>
</template>
<script>
import UtensilCard from "@/Components/UtensilCard.vue"
import {useSinkStore} from "@/Stores/sink";

export default {
  name: 'SinkBasket',
  components: {UtensilCard},
  data() {
    return {
      store: useSinkStore,
    }
  },
  emits: ['removed'],
}
</script>
