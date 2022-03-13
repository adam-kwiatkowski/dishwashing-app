<template>
  <div
    class="
      p-4
      col-span-7
      sm:col-span-4
      rounded-lg
      border-2 border-dashed border-gray-300
      flex flex-col
      m-4
      sm:ml-0
    "
  >
    <div class="grid grid-cols-3 sm:grid-cols-4 gap-4" v-if="!sinkEmpty">
      <TransitionGroup>
        <UtensilCard
          v-for="utensil in utensils"
          :key="utensil.id"
          :id="utensil.id"
          :name="utensil.name"
          :quantity="utensil.chosenAmount"
          :class="{'bg-gray-300': chosen.includes(utensil)}"
          @click="choose(utensil)"
        ></UtensilCard>
      </TransitionGroup>
    </div>

    <div class="flex justify-center mt-4" v-else>
      <div class="text-center flex flex-col items-center">
        <svg
          class="w-12 h-12 mb-4 mt-4 flex w-full"
          fill="none"
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="1.2"
          viewBox="0 0 24 24"
          stroke="#D1D5DB"
        >
          <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"></path>
        </svg>
        <h1 class="text-gray-300 font-bold mb-8">The sink is empty</h1>
      </div>
    </div>
    <button
      class="bg-indigo-300 rounded-lg text-white px-4 py-2 mt-4 w-full"
      v-if="!sinkEmpty"
      @click.prevent="wash"
    >
      Wash
    </button>
  </div>
</template>

<script>
import UtensilCard from "@/Components/UtensilCard.vue";
import { Inertia } from '@inertiajs/inertia';
import { store } from "../store.js";

export default {
  components: {
    UtensilCard,
  },
  props: {
    utensils: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      chosen: [],
    };
  },
  methods: {
    choose(utensil) {
      if (this.chosen.includes(utensil)) {
        this.chosen = this.chosen.filter((item) => item !== utensil);
      } else {
        this.chosen.push(utensil);
      }
    },
    wash() {
      Inertia.post("/utensils/wash", {
        utensils: this.chosen,
      });
      this.chosen = [];
    },
  },
  computed: {
    sinkEmpty() {
      return this.utensils.length === 0;
    },
  },
  emits: ["washed"],
}

</script>