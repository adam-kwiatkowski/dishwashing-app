<template>
  <div
    class="
      flex flex-col
      border-t
      bg-white
      sm:bg-transparent
      rounded-lg
      m-4
      sm:m-0 sm:rounded-0 sm:border-0 sm:gap-2
    "
  >
    <EventBar v-for="(event, key) in events_data" :key="key" :event="event" />
  </div>
</template>

<script>
import EventBar from '@/Components/EventBar.vue';
import {Inertia} from '@inertiajs/inertia';

export default {
    props: {
        events: {
        type: Object,
        required: true,
        },
    },
    data() {
        return {
            events_data: this.events.data,
        };
    },
    components: {
        EventBar,
    },
    created() {
        window.addEventListener('scroll', this.handleScroll);
    },
    beforeDestroy() {
        window.removeEventListener('scroll', this.handleScroll);
    },
    methods: {
			handleScroll() {
				if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
					this.loadMore();
				}
			},
			loadMore() {
				if (this.events.next_page_url === null) {
					return
				}

				this.$inertia.get(this.events.next_page_url, {}, {
					preserveState: true,
					preserveScroll: true,
					only: ['events'],
					onSuccess: () => {
					this.events_data = [...this.events_data, ...this.events.data]
					}
				})
			},
    },
}
</script>
