<template>
    <div class="card" :style="`background: ${background};`">
        <h5 class="text-white font-black tracking-wider text-lg md:text-2xl p-0 m-0">
            Citizenship
        </h5>
        <p class="my-9 text-white text-xs md:text-lg">
            Learn about eligibility and our free citizenship classes
        </p>
        <a href="#" class="text-white font-bold underline  text-xl">See all</a>
    </div>
</template>
<script>
export default {
    props: ["background"],
};
</script>
<style lang="scss" scoped>
.card {
    @apply py-5 px-5 rounded-md;
}
</style>
