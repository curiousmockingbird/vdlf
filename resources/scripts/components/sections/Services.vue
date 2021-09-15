<template>
    <SectionContainer containerClasses="min-h-screen flex flex-col justify-center py-20" v-if="content.length>0 && options.title">
        <template slot="beforeContainer">
            <img :src="$images + '/services-circles.png'" class="bg-circle z-0" />
        </template>
        <h4 class="font-bold text-xl md:text-4xl text-black tracking-wider">{{ options.title }}</h4>

        <div class="grid gap-4 mt-14"
            :class="
            'grid-cols-' +
            options.column +
            ' md:grid-cols-' +
            options.md_column +
            ' lg:grid-cols-' +
            options.lg_column
            "
        >
            <ServiceCard 
                :href="item.navigation_link ? item.navigation_link : '#'"
                v-for="(item, i) in content"
                :key="i"
                :background="item.panel_background"
                :color="item.panel_color"
                :title="item.panel_title"
                :content="item.panel_content"
                :link="item.panel_link"
                :button-text="options.button_text"
            >
            </ServiceCard>
        </div>
    </SectionContainer>
</template>

<script>
export default {
    props: ["jsonContent", "jsonOptions"],
    data() {
        return {
            content: {},
            options: {},
        };
    },
    created() {
        if (this.jsonContent) {
            this.content = JSON.parse(this.jsonContent);
        }
        if (this.jsonOptions) {
            this.options = JSON.parse(this.jsonOptions);
        }
    },
};
</script>

<style lang="scss" scoped>
.bg-circle {
    position: absolute;
    right: -200px;
    top: 150px;
    transform: translateY(-50%);
}
</style>
