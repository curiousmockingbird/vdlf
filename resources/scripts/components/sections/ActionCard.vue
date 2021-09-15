<template>
    <article class="card mx-2">
        <div class="card-body py-6 px-7 ">
            <p
                class="inline-block tracking-widest rounded-md uppercase border border-black font-bold text-xs py-1 px-3 "
            >
                {{ label }}
            </p>
            <h4 class="font-bold text-xl mb-5 mt-10">{{title}}</h4>

            <p>
                {{ description }}
            </p>
        </div>
        <a :href="link" class="card-btn " v-if="buttonLabel">
            {{ buttonLabel }}
        </a>
    </article>
</template>
<style lang="scss" scoped>
.card {
    @apply rounded-lg bg-white inline-grid hover:shadow-lg transition-all;
}

.card-btn {
    @apply mt-auto py-8 px-7 text-black hover:text-white hover:bg-green-700 rounded-lg text-xl underline font-bold transition-all;
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
            type:String,
            default:"Read More"
        },
        link:{
            type:String,
            default:"#",
        }
    },
};
</script>
