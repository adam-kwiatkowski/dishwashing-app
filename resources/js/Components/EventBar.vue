<template>
  <div class="sm:bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-4 sm:bg-white border-b border-gray-200 flex flex-row">
      <div class="flex-1">

        <span v-if="event.type === 'washed'"
              class="inline-block w-2 h-2 mr-2 rounded-full bg-green-400 align-middle"></span>
        <span v-else class="inline-block w-2 h-2 mr-2 rounded-full bg-red-400 align-middle"></span>
        {{ event.user }}
        {{ event.type }}
        {{ event.amount }}
        {{ event.utensil }}
      </div>
      <span class="">{{ event.created_at_diff }}</span>
    </div>
  </div>
</template>

<script>

export default {
  props: ['event'],
}
</script>
