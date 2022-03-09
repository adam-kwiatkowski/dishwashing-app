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
      <BlankCard />
      <UtensilCard
        v-for="utensil in utensils.data"
        :key="utensil.id"
        :id="utensil.id"
        :name="utensil.name"
        :quantity="utensil.quantity"
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
        v-model="selectedUtensil.chosenAmount"
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
    created() {
        console.log(this.utensils);
    },
    methods: {
        displayUtensil(id) {
            console.log(id);
        },
				chooseAmount(id) {
					this.selectedUtensil = this.utensils.data.find(
                (utensil) => utensil.id === id
            );
					this.selectedUtensil.chosenAmount = 1;
					if (this.selectedUtensil.quantity == 1) {
						this.$emit('added', this.selectedUtensil);
					}
					else {
						this.showModal = true;
					}
				},
    },
		emits: ["added"],
};
</script>
