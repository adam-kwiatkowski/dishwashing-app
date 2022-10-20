<template>
    <app-layout title="Utensils">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Utensils
            </h2>
        </template>

        <div class="sm:py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex items-start grid grid-cols-7 gap-4">
                    <div class="flex flex-col col-span-7 sm:col-span-5 sm:gap-4">
                        <UtensilsGrid
                            :utensils="utensils"
                            @added="(utensil) => store.addItem(utensil)"
                        ></UtensilsGrid>
                    </div>
                    <UtensilsBasket
                        :utensils="store.basket"
                        @removed="(utensil) => store.removeItem(utensil)"
                    ></UtensilsBasket>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import UtensilsGrid from "@/Components/UtensilsGrid.vue";
import UtensilsBasket from "@/Components/UtensilsBasket.vue";
import {useBasketStore} from "@/Stores/basket";

export default {
    data() {
        return {
            store: useBasketStore,
        };
    },
    props: {
        utensils: {
            type: Object,
            required: true,
        },
    },
    components: {
        AppLayout,
        UtensilsGrid,
        UtensilsBasket,
    },
};
</script>
