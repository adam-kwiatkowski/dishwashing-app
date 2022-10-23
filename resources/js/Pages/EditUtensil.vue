<template>
  <app-layout title="Edit utensil">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Edit utensil
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <UtensilForm has_delete :errors_list="errors" :form="form" :preview_url="previewURL" @submit="submit" @delete="showModal = true"/>
      </div>
    </div>

  <Modal :show="showModal" @close="showModal = false">
    <div class="flex">
      <h1>Confirm</h1>
    </div>
    <div class="flex flex-row w-full justify-center">
      <p>Are you sure you want to delete this utensil?</p>
    </div>
    <div class="flex flex-row w-full justify-center">
      <button
        class="bg-indigo-300 rounded-lg text-white px-4 py-2 mt-4 w-full"
        @click="deleteUtensil"
      >
        Delete
      </button>
    </div>

  </Modal>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import UtensilForm from "@/Components/UtensilForm";
import {useForm} from "@inertiajs/inertia-vue3";
import Modal from "@/Components/Modal";
export default {
  name: "EditUtensil",
  components: {
    Modal,
    AppLayout,
    UtensilForm,
  },
  props: ['errors', 'utensil'],
  data() {
    return {
      form: useForm({
        name: this.utensil.name,
        total_amount: this.utensil.total_amount,
        available: this.utensil.available,
        photo: null,
      }),
      showModal: false,
    }
  },
  methods: {
    submit() {
      this.form.progress = { percentage: 0 }
      this.form.post(`/utensils/${this.utensil.id}`)
    },
    deleteUtensil() {
      this.form.delete(`/utensils/${this.utensil.id}`)
    }
  },
  computed: {
    previewURL() {
      return this.form.photo ? URL.createObjectURL(this.form.photo) : this.utensil.image_url
    }
  },
}
</script>

<style scoped>

</style>
