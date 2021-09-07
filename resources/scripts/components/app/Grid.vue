<template>
    <div
        class="highlights-grid grid grid-flow-row flex-wrap "
        :class="['grid-cols-' + cols, 'gap-x-' + gap, 'gap-y-' + gap]"
    >
        <slot />
    </div>
</template>
<script>
export default {
    props: {
        cols: Number,
        gap: Number,
    },
};
</script>
