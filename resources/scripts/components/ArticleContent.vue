<template>
    <SectionContainer class="pb-10">
        <ArticleMedia v-if="image" :media="image"/>
        <hr v-else class="border-t-2 border-opacity-50 border-themeBlackAlt" />
        <div class="mt-10 mb-20 w-full rounded-md article-content text-formatting-enable text-xl">
            <slot />
            <div class="w-full mt-10 -mx-2" v-if="tagPosts">
                <button class="bg-orange py-4 px-5 text-white rounded-md m-2" v-for="(tag, i) in tagPosts"
                :key="i">
                    #{{capitalizeWord(tag.name) }}
                </button>
            </div>
        </div>
    </SectionContainer>
</template>
<script>
export default {
    data() {
        return {
            tagPosts:null,
        }
    },
    props:{
        image: {
            type:String,
        },
        tags:{
            type: String,
        },
    },
    created() {
        if (this.tags) {
            this.tagPosts= JSON.parse(this.tags);
        }
    },
}
</script>
<style lang="scss">
.article-content {
    p {
        margin-bottom: 10px;
    }
    iframe {
        @apply max-w-full;
    }
}
</style>