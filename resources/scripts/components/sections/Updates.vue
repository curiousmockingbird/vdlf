<template>
    <SectionContainer containerClasses="min-h-screen flex flex-col justify-center py-5 md:py-20">
        <template slot="beforeContainer">
            <img
                class="section-bg"
                :src="content.images.url ? content.images.url : $images + '/updates-bg.png'"
                alt=""
            />
        </template>
        <h4 class="font-bold leading-tight text-2xl md:text-4xl text-white tracking-wider">
            {{ content.title }}
        </h4>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-10">
            <UpdatesCardNew
                v-for="(item, i) in updates"
                :key="i"
                :title="item.title"
                :excerpt="item.excerpt"
                :categories="item.categories"
                :date="item.date"
                :link="item.link ? item.link : '#'"
                :moreLabel="content.button_more_text"
            ></UpdatesCardNew>
        </div>
        <a
            :href="content.button_link.url"
            class="text-white font-display font-bold underline text-xl md:text-2xl block my-10"
            >{{ content.button_text }}</a
        >
    </SectionContainer>
</template>
<style lang="scss" scoped>
.section-bg {
    @apply absolute w-full h-full object-cover top-0 left-0 z-0;
}
</style>

<script>
export default {
    props: {
        jsonContent: String,
        title: {
            type: String,
            default: "Press Releases and Updates",
        },
    },
    data() {
        return {
            updates: [],
            page: 1,
            content: {
                title: "Press Releases and Updates",
                button_text: "View all Press Releases",
                button_link: {
                    url: "#",
                },
                button_more_text: "Continue Reading",
                images: {
                    url: "",
                },
                perpage: 3,
            },
        };
    },
    methods: {
        getData() {
            let formData = {
                page: this.page,
                perpage: this.content.perpage,
                // categories: "press-release",
                language: this.$settings.language,
                sortby: "latest",
            };
            this.$api.Posts.getUpdates(formData).then(({ data }) => {
                this.updates.push(...data.posts);
            });
        },
    },
    created() {
        if (this.jsonContent) {
            this.content = JSON.parse(this.jsonContent);
        }
    },
    mounted() {
        this.getData();
    }
};
</script>
