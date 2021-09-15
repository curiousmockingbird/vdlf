<template>
    <SectionContainer containerClasses="md:min-h-screen flex flex-col justify-center py-20 lg:py-0">
        <h3 class="text-2xl tracking-widest font-black text-white">{{ title }}</h3>

        <div class="content-fellows w-full overflow-hidden">
            <div id="fellow-slides" class="relative">
                <VueSlickCarousel
                    v-bind="sliderSettings"
                    class="slideshow mt-5 mb-8"
                    v-if="ActionsData && ActionsData.length > 0"
                >
                    <ActionCard
                        v-for="(item, i) in ActionsData"
                        :key="i"
                        :title="item.title"
                        :description="item.excerpt"
                        :email="item.email"
                        :label="label"
                        :buttonLabel="buttonLabel"
                        :body="item.content"
                    ></ActionCard>
                </VueSlickCarousel>
            </div>
        </div>
    </SectionContainer>
</template>
<script>
import VueSlickCarousel from "vue-slick-carousel";
import "vue-slick-carousel/dist/vue-slick-carousel.css";
// optional style for arrows & dots
import "vue-slick-carousel/dist/vue-slick-carousel-theme.css";

export default {
    components: { VueSlickCarousel },
    data() {
        return {
            sliderSettings: {
                dots: false,
                infinite: true,
                speed: 800,
                arrows: true,
                slidesToShow: 6,
                slidesToScroll: 1,
                autoplaySpeed: 6000,
                swipeToSlide: true,
                swipe: true,
                variableWidth: true,
            },
        };
    },
    props: {
        ActionsData: Array,
        title: {
            type: String,
            default: "Take Action",
        },
        label: {
            type: String,
            default: "Action",
        },
        buttonLabel: {
            type: String,
            default: "Email Now",
        },
    },
};
</script>
