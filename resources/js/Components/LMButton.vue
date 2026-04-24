<script setup lang="ts">
const props = defineProps<{
    style?: 'primary' | 'secondary' | 'danger';
}>();

const emit = defineEmits<{
    click: [];
}>();

</script>
<template>
    <button
        @click="emit('click')"
        :class="[
            'cursor-pointer rounded-lg px-4 py-3 text-sm font-medium transition disabled:cursor-not-allowed disabled:bg-slate-800/50 disabled:text-slate-500',
            props.style === 'primary' ? 'bg-slate-900/70 text-slate-100 hover:bg-slate-900/90' :
            props.style === 'secondary' ? 'bg-slate-700/70 text-slate-200 hover:bg-slate-700/80' :
            props.style === 'danger' ? 'bg-red-600/70 text-white hover:bg-red-600/80' : ''
        ]"
    >
        <slot />
    </button>
</template>
