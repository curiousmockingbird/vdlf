<template>
    <div class="background-gradient">
        <HeroAction :slideshow="content.slideshow"></HeroAction>
        <TakeAction
            :actions-name="content.take_action_tax"
            :title="content.take_action_title"
            :perpage="content.perpage"
        ></TakeAction>
    </div>
</template>
<script>
export default {
    props: ["jsonContent"],
    data() {
        return {
            actions: [],
            content: {
                take_action_title: "Take Action",
                take_action_label: "Action",
                images: {
                    url: "",
                },
                perpage: 3,
                slideshow: [],
            },
        };
    },
    created() {
        if (this.jsonContent) {
            this.content = JSON.parse(this.jsonContent);
        }
    },
};
</script>

<style lang="scss" scoped>
.background-gradient {
    background: linear-gradient(180deg, #f0a341 0%, #c22d28 100%);
}
</style>
