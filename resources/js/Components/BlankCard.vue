<template>
  <div>
    <div
      class="
        flex flex-col
        items-center
        justify-center
        h-full
        border-dashed border-2
        rounded-lg
        hover:bg-gray-200
        hover:border-solid
        transition-all
        duration-300
        ease-in-out
        sm:cursor-pointer
        p-2
        sm:p-4
      "
    >
      <div
        class="
          flex flex-col
          items-center
          justify-center
          h-12
          w-12
          rounded-full
          bg-gray-100
          text-gray-500
        "
      >
        <svg
          class="h-6 w-6"
          fill="none"
          stroke="currentColor"
          viewBox="0 0 24 24"
        >
          <path
            d="M12 6v6m0 0v6m0-6h6m-6 0H6"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
          />
        </svg>
      </div>
      <div class="mt-2 text-center text-sm text-gray-500">Add new</div>
    </div>
  </div>
</template>

<script>
  export default {};
</script>
