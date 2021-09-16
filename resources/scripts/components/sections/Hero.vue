<template>
    <div class="background-gradient">
        <HeroAction
            :title="content.title"
            :link="content.button_link.url"
            :button_icon="content.button_icon"
            :button_text="content.button_text"
            :images="content.images.url"
        ></HeroAction>
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
                title: "Email your Representative to Win Citizenship for All",
                button_text: "Let's Go!",
                button_link: {
                    url: "#",
                },
                take_action_title: "Take Action",
                take_action_label: "Action",
                images: {
                    url: "",
                },
                perpage: 3,
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
