<template>
    <SectionContainer containerClasses="md:min-h-screen" :style="`background-color:${background}`">
        <img :src="$images + '/hero-circle.png'" class=" bg-circle z-0" />
        <div class="md:h-screen relative">
            <div class=" content-text relative ">
                <h1 class="font-bold text-3xl md:text-5xl leading-tight" style="max-width: 700px;">
                    {{ title }}
                </h1>
                <a
                    :href="link"
                    class="block mt-6 text-2xl md:text-3xl text-white font-bold underline"
                >
                    <svg-vue
                        v-if="button_icon && button_icon != 'null' && button_icon != 'none'"
                        :icon="`${button_icon}-icon`"
                        height="48px"
                        width="48px"
                        class="inline-block mr-5"
                        style="fill: none; "
                    ></svg-vue
                    >{{ button_text }}</a
                >
            </div>
        </div>

        <template slot="afterContainer">
            <div class="img-container">
                <img
                    :src="images ? images : $images + '/hero-img.png'"
                    class="hero-image z-20"
                    alt=""
                />
            </div>
        </template>
    </SectionContainer>
</template>

<script>
export default {
    props: {
        background: {
            default: "transparent",
        },
        title: {
            type: String,
            default: "Email your Representative to Win Citizenship for All",
        },
        link: {
            type: String,
            default: "#",
        },
        button_icon: {
            type: String,
            default: "email",
        },
        button_text: {
            type: String,
            default: "Join Now",
        },
        images: {
            type: String,
        },
    },
};
</script>
<style lang="scss" scoped>
.background-gradient {
    background: linear-gradient(180deg, #f0a341 0%, #c22d28 100%);
}

.hero-image {
    position: absolute;
    height: 100%;
    object-fit: cover;
}

.img-container {
    padding-bottom: 90%;
    position: relative;
    overflow: hidden;
    margin: 15px;
}
@screen md {
    .img-container {
        padding-bottom: 0;
        overflow: none;
        margin: 0;
        position: absolute;
        width: 50%;
        height: 100vh;
        right: 0;
        top: 0;
        padding: 0px;
    }

    .hero-image {
        object-fit: cover;
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
        left: -375px;
        top: 48%;
        transform: translateY(-50%);
        min-width: auto;
    }
}

.content-text {
    position: absolute;
    left: 0;
    max-width: 351px;
    top: 0;
    padding-top: 65px;
    transform: none;
    padding-bottom: 40px;
}

@screen md {
    .content-text {
        padding: 0;
        left: 100px;
        max-width: 351px;
        top: 48%;
        transform: translateY(-50%);
    }
}
</style>
