<template>
  <div
    class="
      bg-white
      overflow-hidden
      sm:shadow-sm sm:rounded-lg
      p-4
      flex flex-col flex-1
    "
  >
    <div class="grid grid-cols-3 sm:grid-cols-5 gap-4">
      <BlankCard @click="createNew"/>
      <UtensilCard
        v-for="utensil in utensils.data"
        :key="utensil.id"
        :id="utensil.id"
        :name="utensil.name"
        :quantity="utensil.quantity"
        :image_url="utensil.image_url"
        @click="chooseAmount(utensil.id)"
      ></UtensilCard>
    </div>
    <Pagination
      :links="utensils.links"
      :prev_page_url="utensils.prev_page_url"
      :next_page_url="utensils.next_page_url"
      :from="utensils.from"
      :to="utensils.to"
      :total="utensils.total"
    ></Pagination>
  </div>

  <Modal :show="showModal" @close="showModal = false">
    <h1>Use {{ selectedUtensil.name }}</h1>
    <div class="flex flex-row w-full justify-center">
      <NumberInput
        :max="selectedUtensil.quantity"
        v-model="selectedUtensil.used"
      ></NumberInput>
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
import Pagination from "@/Components/Pagination.vue";
import BlankCard from "@/Components/BlankCard.vue";
import Modal from "@/Components/Modal.vue";
import NumberInput from "@/Components/NumberInput.vue";
import { Inertia } from '@inertiajs/inertia';

export default {
    components: {
        UtensilCard,
        Pagination,
        BlankCard,
        Modal,
        NumberInput,
    },
    data() {
        return {
            showModal: false,
            selectedUtensil: Object,
        };
    },
    props: ["utensils"],
    methods: {
				chooseAmount(id) {
					this.selectedUtensil = this.utensils.data.find(
                (utensil) => utensil.id === id
            );
					this.selectedUtensil.used = 1;
					if (this.selectedUtensil.quantity == 1) {
						this.$emit('added', this.selectedUtensil);
					}
					else {
						this.showModal = true;
					}
				},
        createNew() {
          Inertia.visit('/utensils/create');
        },
    },
		emits: ["added"],
};
</script>
