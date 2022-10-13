<template>
    <div
        class="
          p-4
          col-span-7
          sm:col-span-4
          rounded-lg
          border-2 border-dashed border-gray-300
          flex flex-col
          m-4
          sm:ml-0
        "
    >
        <div v-if="!sinkEmpty" class="grid grid-cols-3 sm:grid-cols-4 gap-4">
            <TransitionGroup>
                <UtensilCard
                    v-for="utensil in utensils"
                    :id="utensil.id"
                    :key="utensil.id"
                    :class="{'bg-gray-300': chosen.includes(utensil)}"
                    :image_url="utensil.image_url"
                    :name="utensil.name"
                    :quantity="utensil.total_amount - utensil.available"
                    @click="choose(utensil)"
                ></UtensilCard>
            </TransitionGroup>
        </div>

        <div v-else class="flex justify-center mt-4">
            <div class="text-center flex flex-col items-center">
                <svg
                    class="w-12 h-12 mb-4 mt-4 flex w-full"
                    fill="none"
                    stroke="#D1D5DB"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.2"
                    viewBox="0 0 24 24"
                >
                    <path
                        d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"></path>
                </svg>
                <h1 class="text-gray-300 font-bold mb-8">The sink is empty</h1>
            </div>
        </div>
        <button
            v-if="!sinkEmpty"
            class="bg-indigo-300 rounded-lg text-white px-4 py-2 mt-4 w-full"
            @click.prevent="wash"
        >
            Wash
        </button>
    </div>
</template>

<script>
import UtensilCard from "@/Components/UtensilCard.vue";
import {Inertia} from '@inertiajs/inertia';

export default {
    components: {
        UtensilCard,
    },
    props: {
        utensils: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            chosen: [],
        };
    },
    methods: {
        choose(utensil) {
            if (this.chosen.includes(utensil)) {
                this.chosen = this.chosen.filter((item) => item !== utensil);
            } else {
                this.chosen.push(utensil);
            }
        },
        wash() {
            Inertia.post("/utensils", {
                event_type_id: 2,
                utensils: this.chosen,
            });
            this.chosen = [];
        },
    },
    computed: {
        sinkEmpty() {
            return this.utensils.length === 0;
        },
    },
    emits: ["washed"],
}

</script>
