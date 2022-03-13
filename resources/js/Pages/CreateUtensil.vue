<template>
    <app-layout title="Add new utensil">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Add new utensil
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <UtensilForm :errors_list="errors"/>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import UtensilForm from '@/Components/UtensilForm.vue'

    export default defineComponent({
        components: {
            AppLayout,
            UtensilForm,
        },
        props: ['errors'],
    })
</script>
