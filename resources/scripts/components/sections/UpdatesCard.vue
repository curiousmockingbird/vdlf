<template>
    <div class="card">
        <a :href="link">
            <h5 class=" font-black text-themeBlue leading-tight  tracking-wider text-xl p-0 mb-5">{{ title }}</h5>
        </a>
        <span class="text-gray-500 mt-5">{{date}}</span>
        <div v-html="description" class="mt-2 mb-5 text-lg"></div>
        <a :href="link" class="text-black  font-bold underline text-xl block my-5">Continue Reading</a>
    </div>
</template>
<script>
export default {
    props: {
        title: String,
        description: String,
        date: String,
        link: String
    },
};
</script>
<style lang="scss" scoped>
.card {
    @apply flex flex-col py-5 px-6 rounded-md  bg-white;
}
</style>
