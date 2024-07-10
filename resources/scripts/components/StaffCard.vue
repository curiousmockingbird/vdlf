<template>
    <div
        class="overflow-hidden border-2 bg-transparent rounded-lg border-secondary flex flex-col staff-item"
        :class="{'cursor-pointer': clickable}"
        v-on:click="$emit('click', $event)"
    >
        <img
            :src="avatar"
            class="w-full h-64 object-cover"
            :class="'object-'+imagePosition"
            alt=""
        />
        <div class="header bg-transparent p-3 w-full">
            <h4 class="text-lg text-black font-semibold">{{ title }}</h4>
            <div class="text-base profession leading-tight mt-1 text-black mb-0" v-html="profession"></div>
            {{ year }}
        </div>
        <div class="block break-all text-base p-3 m-0 text-black mt-auto" v-if="email">
            <!-- <p><span class="font-semibold border-b inline-block border-primary mr-2">{{ $settings.label.phone}} </span>{{ phone }}</p> -->
            
            <p>
                <span class="font-semibold border-b inline-block border-primary mr-2">{{ $settings.label.email}} </span>
                <a :href="mailto(this.email)" class="break-words relative z-10 cursor-pointer" target="_blank">{{ email }}</a>
            </p>
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
    .staff-item > img[src*="logo.png"] {
        @apply p-5 bg-white;
        object-fit: contain !important;
    }
    .staff-item:hover {
        @apply bg-gradient-to-b from-primary to-secondary text-white;
		h4, span, .profession, a, p {
			color:#FFF !important;
			background-color: transparent !important;
		}
    }
</style>