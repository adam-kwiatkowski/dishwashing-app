<template>
  <app-layout title="Dishwashing">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Dishwashing
      </h2>
    </template>

    <div class="sm:py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex items-start grid grid-cols-7 gap-4">
          <UtensilsSink
            :utensils="utensils"
            @added="(utensil) => store.addItem(utensil)"
            @removed="(utensil) => store.removeItem(utensil)">
          </UtensilsSink>
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
import {useSinkStore} from "@/Stores/sink";

export default {
  data() {
    return {
      store: useSinkStore,
    }
  },
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
}
</script>
