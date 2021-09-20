<template>
    <section class="md:min-h-screen relative">
        <img :src="$images + '/hero-circle.png'" class=" bg-circle z-0" />

        <VueSlickCarousel v-bind="settings" class=" slideshow ">
            <div class="slide" v-for="(slide, i) in slideshow" :key="i">
                <div class="flex justify-center">
                    <div class="content-text">
                        <div class="heading">
                            <h1 class="font-bold text-3xl md:text-5xl leading-tight">
                                {{ slide.title }}
                            </h1>
                            <a
                                :href="slide.btn_link"
                                class="block mt-6 text-2xl md:text-3xl text-white font-bold underline"
                            >
                                <img
                                    v-if="slide.image_icon.id != ''"
                                    :src="slide.image_icon.url"
                                    height="48px"
                                    width="48px"
                                    class="inline-block mr-5 svg"
                                />{{ slide.btn_text }}</a
                            >
                        </div>
                    </div>

                    <div class="content-img">
                        <img
                            :src="slide.image.url ? slide.image.url : $images + '/hero-img.png'"
                            class="hero-image z-20 "
                        />
                    </div>
                </div>
            </div>
        </VueSlickCarousel>
    </section>
</template>

<script>
import VueSlickCarousel from "vue-slick-carousel";
import "vue-slick-carousel/dist/vue-slick-carousel.css";
// optional style for arrows & dots
import "vue-slick-carousel/dist/vue-slick-carousel-theme.css";

export default {
    components: { VueSlickCarousel },

    props: {
        slideshow: null,
    },
    data() {
        return {
            settings: {
                dots: false,
                fade: true,
                infinite: true,
                autoplaySpeed: 8000,
                speed: 800,
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: true,
                autoplay: true,
            },
        };
    },

    mounted() {
        console.log(this.slideshow);
        const circle = document.querySelector(".bg-circle");
        const heading = document.querySelector(".heading");
        const offset = -530;
        setTimeout(() => {
            alignCircles();
        }, 400);
        window.addEventListener("resize", () => alignCircles());
        function alignCircles() {
            let headingPosX = heading.getBoundingClientRect().x;
            circle.style.left = headingPosX + offset + "px";
        }
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

.bg-circle {
    position: absolute;
    left: -234px;
    top: -185px;
    min-width: 670px;
}

@screen md {
    .bg-circle {
        left: -375px;
        top: 50%;
        transform: translateY(-50%);
        min-width: auto;
        min-width: 1335px;
        min-height: 1335px;
    }
}

.slideshow {
    @apply min-h-screen w-full;
}

.slide {
    @apply h-screen z-10;
}

.content-text {
    position: absolute;

    padding-top: 65px;
    padding-bottom: 40px;

    .heading {
    }
}

@screen md {
    .content-text {
        position: relative;
        @apply w-1/2 flex justify-center;
        padding: 0;

        .heading {
            @apply flex flex-col justify-center;
            max-width: 430px;
            width: 430px;
        }
    }
}

.content-img {
    padding-bottom: 90%;
    position: relative;
    overflow: hidden;
    margin: 15px;
}
@screen md {
    .content-img {
        @apply w-1/2;

        position: relative;
        padding-bottom: 0;
        overflow: none;
        margin: 0;
        height: 100%;
        padding: 0px;
    }

    .hero-image {
        object-fit: cover;
    }
}
</style>
