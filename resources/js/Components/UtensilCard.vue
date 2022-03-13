<template>
  <div
    class="
      flex flex-col
      items-center
      p-2
      sm:p-4
      rounded-lg
      hover:bg-gray-200
      transition-all
      ease-out
      duration-300
      cursor-pointer
    "
  >
    <div class="shrink-0 h-16 w-16 sm:h-24 sm:w-24 bg-gray-100 rounded-full">
      <img class="h-16 w-16 sm:h-24 sm:w-24 rounded-full" :src="this.image_url" alt="" />
    </div>
    <div class="text-center pt-4">
      <div class="text-sm leading-5 font-medium text-gray-900">
        {{ capitalizedName }}
      </div>
      <div class="mt-2 text-sm leading-5 text-gray-500">
        {{ quantity }}
      </div>
    </div>
  </div>
</template>

<script>
export default {
	props: ["id", "name", "quantity", "image_url"],
	computed: {
		capitalizedName() {
				return this.name.charAt(0).toUpperCase() + this.name.slice(1);
		},
	},
};
</script>
