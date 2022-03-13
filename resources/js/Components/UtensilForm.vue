<template>
  <form @submit.prevent="submit">
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mx-4">
      <div class="sm:row-span-2 bg-indigo-300 rounded-lg pt-4">
        <div class="flex flex-col items-center justify-between h-full sm:p-4">
          <div class="shrink-0 h-48 w-48 bg-gray-100 rounded-full">
            <img
              v-if="previewURL"
              class="w-48 h-48 rounded-full"
              :src="previewURL"
              alt=""
            />
          </div>

          <FilePicker v-model="form.photo" :progress="form.progress" class="py-4 align-self-end m-4"/>
          <div v-if="!form.progress" class="h-3 mt-4"></div>
        </div>
      </div>
      <div class="bg-indigo-100 rounded-lg p-4 pb-16">
        <div class="grid grid-cols-2 gap-4">
          <div class="col-span-2">
            <label class="block text-sm font-medium text-gray-700">
              Name
            </label>
            <input
              type="text"
              class="
                block
                w-full
                px-3
                py-2
                my-2
                text-sm
                leading-tight
                border-0
                rounded
                focus:outline-none focus:border-gray-500
              "
              v-model="form.name"
              placeholder="Name"
            />
          </div>
          <div class="col-span-2">
            <label class="block text-sm font-medium text-gray-700">
              Quantity
            </label>
            <input
              type="number"
              class="
                block
                w-full
                px-3
                py-2
                my-2
                text-sm
                leading-tight
                border-0
                rounded
                focus:outline-none focus:border-gray-500
              "
              v-model="form.quantity"
              placeholder="Quantity"
            />
          </div>
        </div>
      </div>

      <div class="bg-indigo-100 rounded-lg p-4 flex justify-end gap-4">
        <Link
          :href="route('utensils.index')"
          class="
            inline-flex
            items-center
            px-4
            py-2
            text-sm
            leading-5
            font-medium
            rounded-md
            text-indigo-600
            bg-white
            hover:cursor-pointer
            hover:bg-gray-100
            hover:text-indigo-500
            active:text-indigo-700 active:bg-indigo-100
            transition
            duration-150
            ease-in-out
          "
        >
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path
              fill-rule="evenodd"
              d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
              clip-rule="evenodd"
            />
          </svg>
          <span class="ml-2">Cancel</span>
        </Link>
        <button
          type="submit"
          class="
            inline-flex
            items-center
            px-4
            py-2
            border border-transparent
            text-sm
            leading-5
            font-medium
            rounded-md
            text-white
            bg-indigo-300
            hover:bg-indigo-400
            active:bg-indigo-700
            transition
            duration-150
            ease-in-out
          "
        >
          Add
          <svg
            class="ml-1 h-4 w-4 text-indigo-200"
            fill="currentColor"
            viewBox="0 0 20 20"
          >
            <path
              fill-rule="evenodd"
              d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
              clip-rule="evenodd"
            />
          </svg>
        </button>
      </div>
    </div>
  </form>
</template>

<script>

import { useForm, Link } from '@inertiajs/inertia-vue3'
import FilePicker from '@/Components/FilePicker.vue'

export default {
    components: {
        FilePicker,
        Link
    },
    setup () {
        const form = useForm({
            name: null,
            quantity: null,
            photo: null,
        })

        function submit() {
            form.progress = {percentage:0}
            form.post('/utensils')
        }

        return { form, submit }
    },
    computed: {
        previewURL() {
            return this.form.photo ? URL.createObjectURL(this.form.photo) : ''
        }
    }
}

</script>