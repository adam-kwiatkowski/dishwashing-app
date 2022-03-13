<template>
  <div
    class="
      flex flex-col
      col-span-7
      m-4
	  sm:ml-0
      sm:col-span-3
      border-t
      bg-white
      sm:bg-transparent
      rounded-lg
      sm:rounded-0 sm:border-0 sm:gap-2
    "
  >
    <EventBar v-for="(event, key) in events_data" :key="key" :event="event" />
    <span ref="loadMoreIntersect" />
  </div>
</template>

<script>
import EventBar from "@/Components/EventBar.vue";
import { Inertia } from "@inertiajs/inertia";

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
			initialUrl: this.$page.url,
        };
    },
    components: {
        EventBar,
    },
    mounted() {
        const observer = new IntersectionObserver((entries) =>
            entries.forEach(
                (entry) => entry.isIntersecting && this.loadMore(),
                {
                    rootMargin: "10px 0px 0px 0px",
                }
            )
        );

        observer.observe(this.$refs.loadMoreIntersect);
    },
    methods: {
		loadMore() {
        if (this.events.next_page_url === null) {
            return;
        }

        this.$inertia.get(
            this.events.next_page_url,
            {},
            {
                preserveState: true,
                preserveScroll: true,
                only: ["events"],
                onSuccess: () => {
					window.history.replaceState({}, this.$page.title, this.initialUrl);
                    this.events_data = [
                        ...this.events_data,
                        ...this.events.data,
                    ];
                },
            }
        );
    },
	}
};
</script>
