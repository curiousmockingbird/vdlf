<template>
    <section class="section bg-bbBlank relative" :class="[sectionClasses]">
        <slot name="beforeContainer" />
        <div class="container mx-auto z-10 relative" :class="containerClasses">
            <slot />
        </div>

        <div
            v-if="backgroundOverlay !== 0"
            class="background-overlay "
            :class="'overlay-' + backgroundOverlay"
        ></div>
        <img
            v-if="backgroundImage"
            :src="backgroundImage"
            class="background-image"
            alt="section background"
        />
    </section>
</template>
<script>
export default {
    props: {
        backgroundImage: String,
        backgroundOverlay: {
            type: Number,
            default: 0,
        },
        containerClasses: String,
        sectionClasses: String,
    },
};
</script>
<style lang="scss" scoped>
.background-overlay,
.background-image {
    @apply absolute top-0 left-0 w-full h-full;
}

.background-overlay {
    z-index: 1;
    &.overlay-1 {
        background: linear-gradient(
            0deg,
            #f89a1e 0%,
            #f37721 18.6%,
            #e72c2a 40.01%,
            #ed245c 58.56%,
            #a80b7a 79.66%,
            #852665 100%
        );
        mix-blend-mode: multiply;
    }

    .overlay-2 {
        background: linear-gradient(90deg, #852665 0%, #a80b7a 45.58%, #e72c2a 103.43%);
        transform: rotate(-180deg);
    }
}

.background-image {
    z-index: 0;
    object-fit: cover;
}
</style>
