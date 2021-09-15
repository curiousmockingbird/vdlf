<template>
    <article class="headline-card">
        <h3 v-html="title" class="font-body font-semibold text-3xl leading-9"></h3>
        <p v-html="description" class="leading-tight"></p>
        <div
            class="card-footer flex justify-between mt-3 pt-5 justify-self-end  min-w-full mt-auto"
        >
            <p class="text-secondaryPinot-500 font-semibold text-sm">By {{ author }}</p>
            <p class="text-black-100 font-semibold text-sm">{{ date }}</p>
        </div>
    </article>
</template>
<script>
export default {
    props: {
        title: String,
        description: String,
        author: String,
        date: String,
    },
};
</script>
<style lang="scss" scoped>
.headline-card {
    @apply bg-white rounded-lg py-6 px-6 flex flex-col mx-2;

    width: 515px;
}
</style>
