<template>
  <div
    class="
      bg-white
      border-t
      col-span-7
      flex flex-col
      rounded-lg
      sm:bg-transparent
      sm:col-span-3
      sm:rounded-0 sm:border-0 sm:gap-2
    "
  >
    <EventBar v-for="(event, key) in events.data" :key="key" :event="event"/>
    <span ref="loadMoreIntersect"/>
  </div>
</template>

<script>
import EventBar from "@/Components/EventBar.vue";

export default {
  props: {
    events: {
      type: Object,
      required: true,
    },
  },
  components: {
    EventBar,
  },
};
</script>
