<template>
    <section class="md:min-h-content relative px-5 lg:px-0" id="hero-action">
        <img :src="$images + '/hero-circle.png'" class=" bg-circle z-0" />

        <VueSlickCarousel v-bind="sliderSettings" class="slideshow lg:max-h-content" v-if="slideshow.length >0">
            <template #prevArrow>
                <div class="VueCarousel-navigation-prev">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 19l-7-7 7-7"
                        />
                    </svg>
                </div>
            </template>
            <template #nextArrow>
                <div class="VueCarousel-navigation-next">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 5l7 7-7 7"
                        />
                    </svg>
                </div>
            </template>
            <div class="slide" v-for="(slide, i) in slideshow" :key="i">
                <div class="flex flex-col lg:flex-row justify-center ">
                    <div class="content-text">
                        <div class="heading">
                            <h1 class="font-bold text-3xl md:text-4xl leading-tight">
                                {{ slide.title }}
                            </h1>
                            <a
                                :href="slide.btn_link"
                                class="block mt-6 text-2xl flex items-center md:text-3xl text-white font-bold"
                            >
                                <img
                                    v-if="slide.image_icon.id != ''"
                                    :src="slide.image_icon.url"
                                    height="54px"
                                    width="54px"
                                    class="inline-block mr-5 svg py-5"
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
import VueSlickCarousel from 'vue-slick-carousel';
import 'vue-slick-carousel/dist/vue-slick-carousel.css';
// optional style for arrows & dots
import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css';

export default {
    components: { VueSlickCarousel },

    props: {
        slideshow: null,
    },
    data() {
        return {
            sliderSettings: {
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
        const circle = document.querySelector(".bg-circle");
        const heading = document.querySelector(".heading");
        if (circle && heading) {
            const offset = -530;
            setTimeout(() => {
                alignCircles();
            }, 400);
            window.addEventListener("resize", () => alignCircles());
            function alignCircles() {
                if (window.screen.width > 768) {
                    let headingPosX = heading.getBoundingClientRect().x;
                    circle.style.left = headingPosX + offset + "px";
                }
            }
        }
    },
};
</script>
<style lang="scss">
    #hero-action {
        .slick-dots {
            bottom:25px;
            display: flex !important;
            @apply container mx-auto transform flex lg:px-7 inset-x-1/2 -translate-x-1/2;
        }
    }
</style>
<style lang="scss" scoped>
#hero-action {
    .VueCarousel-navigation-prev,
    .VueCarousel-navigation-next {
        @apply bg-white inset-y-1/2 bg-opacity-0 lg:bg-opacity-20 rounded-lg px-1 absolute  z-30;
        display: inline-table;
        svg {
            @apply h-10 w-10 text-white;
        }

        &:hover {
            @apply bg-opacity-40;
        }
    }
}

.background-gradient {
    background: linear-gradient(180deg, #f0a341 0%, #c22d28 100%);
}

.hero-image {
    @screen lg {
        position: absolute;
        height: 100%;
        object-fit: cover;
    }
}

.bg-circle {
    position: absolute;
    left: -250px;
    top: -170px;
    min-width: 690px;
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
    @apply min-h-content w-full;
}

.slide {
    @apply h-content z-10;
}

.content-text {
    position: relative;

    padding-top: 85px;
    padding-bottom: 40px;

    margin: 0 15px;

    .heading {
    }
}

@screen md {
    .content-text {
        position: relative;
        @apply w-full lg:w-1/2 flex justify-center;
        padding: 0;
        margin: 0;
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
        @apply w-full text-center flex justify-center items-center lg:block lg:w-1/2;

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
