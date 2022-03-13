<template>
<div>

    <input
      type="file"
      @input="$emit('update:modelValue', $event.target.files[0])"
      class="
        block
        w-full
        px-4
        text-sm text-slate-500
        file:mr-4
        file:py-2
        file:px-4
        file:rounded-full
        file:border-0
        file:text-sm
        file:font-semibold
        file:bg-violet-50
        file:text-indigo-700
        file:font-sans
        hover:file:cursor-pointer
        hover:file:bg-indigo-100
      "
    />
    <div v-if="progress" class="bg-gray-200 rounded-full h-3 mt-4 flex flex-row">
        <div class="bg-indigo-600 h-3 rounded-full transition-all ease-in-out transition-duration-1000" :style="{width: progress.percentage + '%'}"></div>
    </div>
</div>
</template>

<script>
export default {
    props: ['modelValue', 'progress'],
    emits: ['update:modelValue']
}
</script>