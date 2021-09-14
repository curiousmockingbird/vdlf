<template>
    <SectionContainer containerClasses="min-h-screen flex flex-col justify-center py-20">
        <template slot="beforeContainer">
            <img class="section-bg" :src="$images + '/updates-bg.png'" alt="" />
        </template>
        <h4 class="font-black text-2xl md:text-4xl text-white tracking-wider">{{ title }}</h4>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-14">
            <UpdatesCard
                v-for="(item, i) in updates"
                :key="i"
                :title="item.title"
                :description="item.excerpt"
                :date="item.date"
                :link="item.link"
            ></UpdatesCard>
        </div>
        <a href="#" class="text-white font-display font-bold underline text-3xl block my-10">View all Press Releases</a>
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
        settings:Object,
        title:{
            type:String,
            default:"Press Releases and Updates"
        }
    },
    data() {
        return {
            updates: [],
            page: 1,
            perpage: 3,
        };
    },
    methods: {
        getData() {
            let formData = {
                page: this.page,
                perpage: this.perpage,
                categories: "press-release",
                language:this.$settings.language,
                sortby: "latest",
            };
            this.$api.Posts.getUpdates(formData).then(({ data }) => {
                this.updates.push(...data.posts);
            });
        },
    },
    created() {
        this.getData();
        if (this.settings) {
            this.sectionSettings = JSON.parse(this.settings);
        }
    },
};
</script>
