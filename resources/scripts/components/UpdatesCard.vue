<template>
    <div class="card">
        <div class="py-5 px-6">
            <a :href="link">
                <h5 class=" font-bold text-themeBlue leading-tight  tracking-wider text-xl p-0 mb-5">{{ title }}</h5>
            </a>
            <span class="text-gray-500 mt-2">{{date}}</span>
            <div v-html="description" class="my-3 text-lg"></div>
        </div>
        <a :href="link" class="text-black py-8 px-7 rounded-b-md transition-all hover:bg-themeBrown hover:text-white mt-auto font-bold underline text-xl block">{{ moreLabel }}</a>
    </div>
</template>
<script>
export default {
    props: {
        title: String,
        description: String,
        date: String,
        link: String,
        moreLabel:String
    },
};
</script>
<style lang="scss" scoped>
.card {
    @apply flex flex-col rounded-md  bg-white;
}
</style>
