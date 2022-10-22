<template>
  <app-layout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Dashboard
      </h2>
    </template>

    <div class="sm:py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid gap-1 sm:grid-cols-2 sm:gap-4">
          <EventChart title="Your" :series="your_event_series"/>
          <EventChart title="All" :series="all_event_series"/>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import {defineComponent} from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import EventChart from "@/Components/EventChart";

function mapEvent(event) {
  return [
    event.data.created_at,
    event.data.total_amount
  ];
}

export default defineComponent({
  components: {
    EventChart,
    AppLayout,
  },
  props: {
    stats: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      your_event_series: [
        {
          name: "Used",
          data: this.stats.your.used ? this.stats.your.used.map(mapEvent) : [],
        },
        {
          name: "Washed",
          data: this.stats.your.washed ? this.stats.your.washed.map(mapEvent) : [],
        }
      ],
      all_event_series: [
        {
          name: "Used",
          data: this.stats.all.used ? this.stats.all.used.map(mapEvent) : [],
        },
        {
          name: "Washed",
          data: this.stats.all.washed ? this.stats.all.washed.map(mapEvent) : [],
        }
      ],
    };
  }
})
</script>
