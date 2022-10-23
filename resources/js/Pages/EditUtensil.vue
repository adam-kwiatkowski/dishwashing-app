<template>
  <app-layout title="Edit utensil">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Edit utensil
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <UtensilForm :errors_list="errors" :form="form" :preview_url="previewURL" @submit="submit"/>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import UtensilForm from "@/Components/UtensilForm";
import {useForm} from "@inertiajs/inertia-vue3";
export default {
  name: "EditUtensil",
  components: {
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
      })
    }
  },
  methods: {
    submit() {
      this.form.progress = { percentage: 0 }
      this.form.post(`/utensils/${this.utensil.id}`)
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
