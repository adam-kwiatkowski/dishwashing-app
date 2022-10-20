<template>
  <div
    class="p-4 m-4 mb-8 sm:m-0 col-span-7 sm:col-span-2 rounded-lg border-2 border-dashed border-gray-300 flex flex-col place-self-stretch"
  >
    <div class="grid grid-cols-3 sm:grid-cols-2 gap-4 flex-1 items-start">
      <TransitionGroup>
        <UtensilCard
          v-for="utensil in utensils"
          :id="utensil.id"
          :key="utensil.id"
          :image_url="utensil.image_url"
          :name="utensil.name"
          :quantity="utensil.quantity"
          class="hover:bg-red-200 active:bg-red-300"
          @click="$emit('removed', utensil)"
        ></UtensilCard>
      </TransitionGroup>
    </div>
    <button
      class="bg-indigo-300 rounded-lg text-white px-4 py-2 mt-4 w-full"
      @click.prevent="use"
    >
      Use
    </button>
  </div>
</template>

<script setup>
import UtensilCard from "@/Components/UtensilCard.vue";
import {Inertia} from "@inertiajs/inertia";
import {useBasketStore} from "@/Stores/basket";

defineProps({
  utensils: {
    type: Object,
    required: true,
  },
});
defineEmits({
  removed: {
    type: Object,
    required: true,
  },
});

function use() {
  Inertia.post("/events/use", {
    utensils: useBasketStore.basket,
  });
  useBasketStore.basket = [];
}
</script>
