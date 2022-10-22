<template>
  <div class="
      bg-white
      overflow-hidden
      sm:shadow-sm sm:rounded-lg
      p-4
      flex flex-col flex-1
    ">
    <h1>{{title}}</h1>
    <apexchart :options="options" :series="series" height="350" type="area" width="100%"/>
  </div>
</template>

<script>
import VueApexCharts from "vue3-apexcharts";

export default {
  name: "EventChart",
  components: {
    apexchart: VueApexCharts,
  },
  props: {
    title: {
      type: String,
      required: true,
    },
    series: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      options: {
        xaxis: {
          type: 'datetime',
        }
      },
    };
  },
}
</script>

<style scoped>

</style>
