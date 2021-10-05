<template>
    <div
        class="cursor-pointer overflow-hidden border-2 bg-transparent rounded-lg border-secondary flex flex-col staff-item"
        :class="{'cursor-pointer': clickable}"
        v-on:click="$emit('click', $event)"
    >
        <img
            :src="avatar"
            class="w-full h-72 object-cover"
            :class="'object-'+imagePosition"
            alt=""
        />
        <div class="header bg-transparent p-3 w-full">
            <h4 class="text-lg text-black font-semibold">{{ title }}</h4>
            <div class="text-base leading-tight mt-1 text-black mb-0" v-html="profession"></div>
            {{ year }}
        </div>
        <div class="block break-all text-base p-3 m-0 text-black mt-auto" v-if="email">
            <a :href="mailto(this.email)" class="break-words relative z-50 cursor-divointer" target="_blank">
                <span class="font-semibold border-b inline-block border-primary mr-2">Email </span>
                <br>{{ email }}
            </a>
        </div>
    </div>
</template>

<script>
export default {
    props:{
        avatar: String,
        imagePosition: String,
        title: String,
        profession: String,
        email: String,
        phone: String,
        year: String,
        clickable: Boolean,
    }
}
</script>

<style lang="scss" scoped>
    img[src*="logo.png"] {
        @apply p-5 bg-white;
        object-fit: contain !important;
    }
</style>