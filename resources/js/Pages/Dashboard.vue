<template>
  <app-layout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Dashboard
      </h2>
    </template>

    <div class="sm:py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 gap-4">
          <EventChart :title="'Your statistics'" :series="your_series"></EventChart>
          <EventChart :title="'Overall statistics'" :series="all_series"></EventChart>
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
    event.created_at,
    event.amount
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
  mounted() {
    console.log(this.stats)
  },
  computed: {
    your_series() {
      return [
        {
          name: 'Used',
          data: this.stats.your.used.data.map(mapEvent),
        },
        {
          name: 'Washed',
          data: this.stats.your.washed.data.map(mapEvent),
        }
      ]
    },
    all_series() {
      return [
        {
          name: 'Used',
          data: this.stats.all.used.data.map(mapEvent),
        },
        {
          name: 'Washed',
          data: this.stats.all.washed.data.map(mapEvent),
        }
      ]
    },
  },
})
</script>
