<template>
    <div class="card" :style="`background: ${background}; color:${color};`">
        <h5 class="text-white font-black tracking-wider text-lg md:text-2xl p-0 m-0">
            {{ title }}
        </h5>
        <p class="my-9 text-white text-xs md:text-lg">
            {{ content }}
        </p>
        <a href="#" class="text-white mt-auto font-bold underline  text-xl">{{ buttonText }}</a>
    </div>
</template>
<script>
export default {
    props: ["background","color","title","content","link","buttonText"],
};
</script>
<style lang="scss" scoped>
.card {
    @apply flex flex-col py-5 px-5 rounded-md;
}
</style>
