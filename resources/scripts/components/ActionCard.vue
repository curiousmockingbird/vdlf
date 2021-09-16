<template>
    <article class="card mx-2">
        <div class="card-body py-6 px-7 ">
            <!-- <p
                class="inline-block tracking-widest rounded-md uppercase border border-black font-bold text-xs mt-3 py-1 px-3 "
            >
                {{ label }}
            </p> -->
            <h4 class="font-bold text-xl my-5">{{ title }}</h4>

            <p>
                {{ description }}
            </p>
        </div>
        <a :href="link" class="card-btn " v-if="buttonLabel">
            <svg-vue
                v-if="icon && icon !='null'"
                :icon="`${icon}-icon`"
                height="48px"
                width="48px"
                class="inline-block mr-5"
                style="fill: none; "
            ></svg-vue
            >{{ buttonLabel }}
        </a>
    </article>
</template>
<style lang="scss" scoped>
.card {
    @apply rounded-lg bg-white inline-grid hover:shadow-lg transition-all;
}

.card-btn {
    @apply mt-auto py-8 px-7 w-full block text-black hover:text-white hover:bg-green-700 rounded-b-lg text-xl underline font-bold transition-all;
}
</style>
<script>
export default {
    props: {
        title: String,
        description: String,
        body: String,
        label: String,
        buttonLabel: {
            type: String,
            default: "Read More",
        },
        link: {
            type: String,
            default: "#",
        },
        icon: {
            type: String,
            default:"email"
        }
    },
};
</script>
