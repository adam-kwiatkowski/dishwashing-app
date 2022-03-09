<template>
  <div
    class="
      border-2 border-dashed border-gray-300
      flex flex-col
      overflow-hidden
      sm:rounded-lg
      p-4
    "
  >
    <div class="grid grid-cols-3 sm:grid-cols-4 gap-4">
      <TransitionGroup>
        <UtensilCard
          v-for="utensil in utensils"
          :key="utensil.id"
          :id="utensil.id"
          :name="utensil.name"
          :quantity="utensil.chosenAmount"
          @click="$emit('removed', utensil)"
        ></UtensilCard>
      </TransitionGroup>
    </div>
    <button
      class="bg-indigo-300 rounded-lg text-white px-4 py-2 mt-4 w-full"
      @click.prevent=""
    >
      Wash
    </button>
  </div>
</template>

<script setup>
import UtensilCard from "@/Components/UtensilCard.vue";
import { Inertia } from '@inertiajs/inertia';
import { store } from "../store.js";

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

</script>