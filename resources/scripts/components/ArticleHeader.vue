<template>
    <SectionContainer
        containerClasses="header-container py-10 flex flex-col justify-center align-center align-center relative"
        class="header-section "
        :backgroundOverlay="2"
    >
        <a :href="categoryLink" class="text-themeRed text-lg md:text-xl">Back to <b>Updates and Press Releases</b></a>
        <h1 class="font-display font-semibold text-4xl md:text-5xl lg:text-title text-primary leading-none py-10 lg:py-20" v-html="title"></h1>

        <div class="content-meta md:flex justify-between">
            <div class="flex leading-7 flex-col">
                <span class="text-themeBlackAlt text-2xl my-1">{{ date }}</span>
                <span class="text-themeBlackAlt mt-1 w-full text-2xl font-semibold inline-block" v-if="categories"
                    v-html="category.length
                    ? category.map((el) => `<a href='${categoryLink}?cat=${el.slug}'>${el.name}</a>` ).join(', ')
                    : ''">
                </span>
            </div>
            <share-button 
                :title="title"
                :description="description"
                :hashtags="tags"
                class="ml-auto mt-3 md:mt-0 w-full md:w-auto"
            >
            </share-button>
        </div>
    </SectionContainer>
</template>
<script>
export default {
    props: ["title", "author", "date", "description","categories", "tags" ],
    created() {
        if (this.categories)
            this.category = JSON.parse(this.categories);
    },
    computed: {
        categoryLink:function() {
            return this.$settings.pressPage?this.$settings.pressPage:'/updates';
        }
    },
};
</script>
<style lang="scss">
.header-container {
    padding-bottom: 15%;
    padding-top: 10%;
}
</style>