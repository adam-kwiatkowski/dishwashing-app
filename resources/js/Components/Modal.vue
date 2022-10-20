<template>
  <div
    v-if="show"
    class="fixed inset-0 transform transition-all"
  >
    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
  </div>
  <div
    v-if="show"
    class="fixed inset-0 w-full h-screen flex items-center justify-center bg-semi-75"
    @click.self="close"
  >
    <div class="relative w-full max-w-md bg-white shadow-lg rounded-lg p-8 m-8">
      <button
        aria-label="close"
        class="absolute top-0 right-0 text-xl text-gray-500 m-4 hover:bg-gray-100 rounded-full p-1 transition-colors duration-100 ease-out"
        @click.prevent="close"
      >
        <svg
          class="w-4 h-4"
          fill="none"
          stroke="currentColor"
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          viewBox="0 0 24 24"
        >
          <path d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
      <slot/>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    show: {
      required: true,

      type: Boolean,
    },
  },
  emits: ["close"],

  methods: {
    close() {
      this.$emit("close");
    },
  },
};
</script>
