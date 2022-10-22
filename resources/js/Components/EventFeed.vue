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
    <EventBar v-for="(event, key) in loadedEvents.data" :key="key" :event="event"/>
  </div>
</template>

<script>
import EventBar from "@/Components/EventBar.vue";
import {debounce} from "lodash/function";

export default {
  props: {
    events: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      loadedEvents: this.events,
    };
  },
  components: {
    EventBar,
  },
  mounted() {
    this.loadMore();
    window.addEventListener('scroll', debounce(this.loadMore, 100));
  },
  methods: {
    loadMore() {
      let pixelsFromBottom = document.documentElement.scrollHeight - (window.scrollY + window.innerHeight);
      if (pixelsFromBottom < 200 && this.loadedEvents.links.next) {
        axios.get(this.loadedEvents.links.next).then((response) => {
          this.loadedEvents = {
            links: response.data.links,
            data: [...this.loadedEvents.data, ...response.data.data],
          }
        });
      }
    },
  },
  watch: {
    events() {
      this.loadedEvents = this.events;
    },
  },
};
</script>
