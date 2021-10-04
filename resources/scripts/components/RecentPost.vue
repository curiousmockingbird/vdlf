<template>
    <SectionContainer class="pt-10 pb-32">
        <SectionTitle>{{ title }}</SectionTitle>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-10">
            <UpdatesCard
                v-for="(item, i) in updates"
                :key="i"
                :title="item.title"
                :description="item.excerpt"
                :date="item.date"
                :link="item.link"
                moreLabel="Continue Reading"
                class="border-2 border-themeBlue hover:border-opacity-100 hover:shadow-2xl transition-shadow"
            ></UpdatesCard>
        </div>
    </SectionContainer>
</template>

<script>
export default {
    props:{
        exclude: {
            type: String,
        },
        title: {
            type: String,
            default: "Recent Posts",
        },
        limit: {
            type: Number,
            default: 3,
        },
        categorySlug:{
            type: String,
        }
    },
    data() {
        return {
            updates: [],
            featured: null,
            page: 1,
        };
    },
    methods: {
        getData() {
            let formData = {
                page: this.page,
                perpage: this.limit,
                language: this.$settings.language,
                sortby: "latest",
            };
            
            if (this.categorySlug) {
                formData.categories = this.categorySlug;
                formData.taxonomy = "category";
            }

            if (this.exclude) {
                formData.exclude = this.exclude;
            }

            this.$api.Posts.getUpdates(formData).then(({ data }) => {
                this.updates.push(...data.posts);
            });
        },
    },
    created() {
        this.getData();
    },
};
</script>