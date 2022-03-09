<template>
  <div v-if="links.length > 3" class="pt-4">
    <div class="flex flex-1 justify-between sm:hidden">
      <Link
        :href="prev_page_url"
        class="
          relative
          inline-flex
          items-center
          px-4
          py-2
          text-sm
          font-medium
          text-gray-700
          bg-white
          border border-gray-300
          leading-5
          rounded-md
          hover:text-gray-500
          focus:outline-none focus:ring
          ring-gray-300
          focus:border-blue-300
          active:bg-gray-100 active:text-gray-700
          transition
          ease-in-out
          duration-150
        "
      >
        « Previous
      </Link>

      <Link
        :href="next_page_url"
        class="
          relative
          inline-flex
          items-center
          px-4
          py-2
          ml-3
          text-sm
          font-medium
          text-gray-700
          bg-white
          border border-gray-300
          leading-5
          rounded-md
          hover:text-gray-500
          focus:outline-none focus:ring
          ring-gray-300
          focus:border-blue-300
          active:bg-gray-100 active:text-gray-700
          transition
          ease-in-out
          duration-150
        "
      >
        Next »
      </Link>
    </div>

    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
      <div>
        <p class="text-sm text-gray-700 leading-5">
          Showing {{ from }} to {{ to }} of {{ total }} results
        </p>
      </div>
      <div>
        <span class="relative z-0 inline-flex">
          <template v-for="(link, key) in links">
            <div
              v-if="link.url === null"
              :key="key"
              class="
                mr-1
                mb-1
                px-4
                py-2
                text-sm
                leading-4
                text-gray-400
                border
                rounded
              "
              v-html="link.label"
            />
            <Link
              v-else-if="!link.active"
              :key="key + 1"
              class="
                mr-1
                mb-1
                px-4
                py-2
                text-sm
                leading-4
                border
                rounded
                hover:bg-white
                focus:border-indigo-500 focus:text-indigo-500
              "
              :href="link.url"
              v-html="link.label"
            />
            <span
              v-else
              :key="key + 2"
              class="
                mr-1
                mb-1
                px-4
                py-2
                text-sm
                leading-4
                border
                rounded
                text-gray-400
              "
              v-html="link.label"
            />
          </template>
        </span>
      </div>
    </div>
  </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
export default {
  components: {
    Link,
  },
  props: ["links", "prev_page_url", "next_page_url", "from", "to", "total"],
};
</script>
