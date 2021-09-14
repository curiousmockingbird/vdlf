<template>
    <div class="background-gradient">
        <SectionContainer containerClasses="min-h-screen">
            <img :src="$images + '/hero-circle.png'" class=" bg-circle z-0" />
            <div class="h-screen relative">
                <div class=" content-text relative ">
                    <h1 class="font-black text-2xl md:text-4xl leading-10" style="max-width: 700px;">
                        Email your Representative to Win Citizenship for All
                    </h1>
                    <a href="#" class="block mt-10 text-2xl text-white font-black underline"
                        >Let's Go!</a
                    >
                </div>
            </div>

            <template slot="afterContainer">
                <img :src="$images + '/hero-img.png'" class="hero-image z-20" alt="" />
            </template>
        </SectionContainer>
        <TakeAction :actions-data="actions" title="Take Action"></TakeAction>
    </div>
</template>
<script>
export default {
    props: ["settings"],
    data() {
        return {
            actions: [],
            page: 1,
            perpage: 3,
        };
    },
    methods: {
        getData() {
            let formData = {
                page: this.page,
                perpage: this.perpage,
                sortby: "latest",
                language:this.$settings.language,
            };
            this.$api.Posts.getAction(formData).then(({ data }) => {
                this.actions.push(...data.posts);
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
<style lang="scss" scoped>
.hero-image {
    position: relative;
    width: auto;
    padding: 10px;
    height: auto;
}
@screen md {
    .hero-image {
        position: absolute;
        width: 50%;
        height: 100vh;
        right: 0;
        top: 0;
        object-fit: cover;
        padding: 0px;
    }
}

.bg-circle {
    position: absolute;
    left: -234px;
    top: -185px;
    min-width: 670px;
}
@screen md {
    .bg-circle {
        left: -400px;
        top: 48%;
        transform: translateY(-50%);
        min-width: auto;
    }
}

.content-text {
    position: absolute;
    left: 30px;
    max-width: 351px;
    top: 80px;
    transform: none;
}

@screen md {
    .content-text {
        left: 100px;
        max-width: 351px;
        top: 48%;
        transform: translateY(-50%);
    }
}

.background-gradient {
    background: linear-gradient(180deg, #f0a341 0%, #c22d28 100%);
}
</style>
