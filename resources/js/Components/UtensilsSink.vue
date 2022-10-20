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
    <div v-if="!sinkEmpty">
      <div class="grid grid-cols-3 sm:grid-cols-4 gap-4">
        <TransitionGroup>
          <UtensilCard
            v-for="utensil in utensils"
            :id="utensil.id"
            :key="utensil.id"
            :image_url="utensil.image_url"
            :name="utensil.name"
            :quantity="utensil.total_amount - utensil.available"
            class="active:bg-gray-300"
            @click="chooseAmount(utensil)"
          />
        </TransitionGroup>
      </div>
      <div v-if="!chosenEmpty" class="w-full h-0.5 bg-gray-300 rounded-full my-4"/>
      <div v-if="!chosenEmpty" class="grid grid-cols-3 sm:grid-cols-4 gap-4">
        <SinkBasket @removed="(utensil) => $emit('removed', utensil)"/>
      </div>
    </div>

    <div v-else class="flex justify-center mt-4">
      <div class="text-center flex flex-col items-center">
        <svg
          class="w-12 h-12 mb-4 mt-4 flex w-full"
          fill="none"
          stroke="#D1D5DB"
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="1.2"
          viewBox="0 0 24 24"
        >
          <path
            d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"></path>
        </svg>
        <h1 class="text-gray-300 font-bold mb-8">The sink is empty</h1>
      </div>
    </div>
    <button
      v-if="!sinkEmpty"
      class="bg-indigo-300 rounded-lg text-white px-4 py-2 mt-4 w-full"
      @click.prevent="wash"
    >
      Wash
    </button>
  </div>

  <Modal :show="showModal" @close="showModal = false">
    <h1>Wash {{ selectedUtensil.name }}</h1>
    <div class="flex flex-row justify-center">
      <NumberInput
        v-model="selectedUtensil.quantity"
        :max="selectedUtensil.total_amount - selectedUtensil.available"
      />
    </div>
    <button
      class="bg-indigo-300 rounded-lg text-white px-4 py-2 mt-4 w-full"
      @click="
        () => {
          $emit('added', selectedUtensil);
          showModal = false;
        }
      "
    >
      Add
    </button>
  </Modal>
</template>

<script>
import UtensilCard from "@/Components/UtensilCard.vue";
import {Inertia} from '@inertiajs/inertia';
import Modal from "@/Components/Modal";
import SinkBasket from "@/Components/SinkBasket";
import NumberInput from "@/Components/NumberInput";
import {useSinkStore} from "@/Stores/sink";

export default {
  components: {
    SinkBasket,
    UtensilCard,
    NumberInput,
    Modal,
  },
  props: {
    utensils: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      showModal: false,
      selectedUtensil: Object,
      store: useSinkStore,
    };
  },
  methods: {
    wash() {
      console.log(this.store.chosen);
      Inertia.post("/events/wash", {
        utensils: this.store.chosen,
      });
      this.store.chosen = [];
    },
    chooseAmount(utensil) {
      this.selectedUtensil = utensil;
      this.selectedUtensil.quantity = 1;
      this.showModal = true;
    },
  },
  computed: {
    sinkEmpty() {
      return this.utensils.length === 0;
    },
    chosenEmpty() {
      return this.store.chosen.length === 0;
    }
  },
  emits: ["added", "removed"],
}

</script>
