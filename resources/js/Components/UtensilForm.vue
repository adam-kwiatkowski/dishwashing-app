<template>
  <form @submit.prevent="submit">
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mx-4">
      <div class="sm:row-span-2 bg-indigo-300 rounded-lg pt-4">
        <div class="flex flex-col items-center justify-between h-full sm:p-4">
          <div class="shrink-0 h-48 w-48 bg-gray-100 rounded-full">
            <img
              v-if="preview_url"
              :src="preview_url"
              alt=""
              class="w-48 h-48 rounded-full object-cover"
            />
          </div>

          <FilePicker v-model="form.photo" :progress="form.progress" class="py-4 align-self-end m-4"/>
          <div v-if="!form.progress" class="h-3 mt-4"></div>
          <p v-if="errors_list.photo" class="mt-2 text-sm text-red-600 dark:text-red-500">{{ errors_list.photo }}</p>
        </div>
      </div>
      <div class="bg-indigo-100 rounded-lg p-4 pb-16">
        <div class="grid grid-cols-2 gap-4">
          <div class="col-span-2">
            <label class="block text-sm font-medium text-gray-700">
              Name
            </label>
            <input
              v-model="form.name"
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
              placeholder="Name"
              type="text"
            />
            <p v-if="errors_list.name" class="mt-2 text-sm text-red-600 dark:text-red-500">{{ errors_list.name }}</p>
          </div>
          <div class="col-span-2">
            <label class="block text-sm font-medium text-gray-700">
              Quantity
            </label>
            <input
              v-model="form.total_amount"
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
              placeholder="Quantity"
              type="number"
            />
            <p v-if="errors_list.total_amount" class="mt-2 text-sm text-red-600 dark:text-red-500">
              {{ errors_list.total_amount }}</p>
          </div>
          <div v-if="typeof(form.available) !== 'undefined'" class="col-span-2">
            <label class="block text-sm font-medium text-gray-700">
              Available
            </label>
            <input
              v-model="form.available"
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
              placeholder="Available"
              type="number"
            />
            <p v-if="errors_list.available" class="mt-2 text-sm text-red-600 dark:text-red-500">
              {{ errors_list.available }}</p>
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
              clip-rule="evenodd"
              d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
              fill-rule="evenodd"
            />
          </svg>
          <span class="ml-2">Cancel</span>
        </Link>
        <button v-if="has_delete" class="
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
                @click.prevent="$emit('delete')">
          Delete
          <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" stroke-width="{1.5}"
               viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" stroke-linecap="round"
                  stroke-linejoin="round"/>
          </svg>
        </button>
        <button
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
          type="submit"
        >
          Submit
          <svg
            class="ml-1 h-4 w-4 text-indigo-200"
            fill="currentColor"
            viewBox="0 0 20 20"
          >
            <path
              clip-rule="evenodd"
              d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
              fill-rule="evenodd"
            />
          </svg>
        </button>
      </div>
    </div>
  </form>
</template>

<script>

import {Link} from '@inertiajs/inertia-vue3'
import FilePicker from '@/Components/FilePicker.vue'

export default {
  components: {
    FilePicker,
    Link
  },
  props: {
    errors_list: {
      type: Object,
      required: true
    },
    form: {
      type: Object,
      required: true
    },
    preview_url: {
      type: String,
      required: true
    },
    has_delete: {
      type: Boolean,
      required: false,
    }
  },
  emits: ['delete'],
}

</script>
