<template>
  <app-layout title="Dishwashing">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Dishwashing
      </h2>
    </template>

    <div class="sm:py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex items-start grid grid-cols-1 sm:grid-cols-2 gap-4">
          <UtensilsSink :utensils="utensils"></UtensilsSink>
          <EventFeed :events="events"></EventFeed>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue'
import UtensilsSink from '@/Components/UtensilsSink.vue'
import EventFeed from '@/Components/EventFeed.vue'

export default {
    props: {
        utensils: {
            type: Object,
            required: true,
        },
        events: {
            type: Object,
            required: true,
        },
    },
    components: {
        AppLayout,
        UtensilsSink,
        EventFeed,
    },
    mounted() {
      console.log(this.utensils);
    },
}
</script>
