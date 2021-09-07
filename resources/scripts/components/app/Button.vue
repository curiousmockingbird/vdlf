<template>
    <div>
        <button
            v-if="type == 'button'"
            v-on:click="$emit('click', $event)"
            class="items-center cursor-pointer font-button font-medium inline-flex px-6 py-3 transition-all duration-300"
            :class="{
                ' border-primary border-2 text-primary bg-white bg-transparent hover:bg-primary hover:text-white ':
                    variant == 'outline',
                ' bg-primary border-primary border-2 text-white  hover:bg-opacity-0 hover:text-primary ':
                    variant == 'primary',
            }"
        >
            <span><slot /></span>
            <svg xmlns="http://www.w3.org/2000/svg" class="ml-3 text-primary h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
            </svg>
        </button>
        <a v-else
            :href="href"
            class="items-center cursor-pointer font-button font-medium inline-flex px-6 py-3 transition-all duration-300"
            :class="{
                ' border-primary border-2 text-primary bg-white bg-transparent hover:bg-primary hover:text-white ':
                    variant == 'outline',
                ' bg-primary border-primary border-2 text-white  hover:bg-opacity-0 hover:text-primary ':
                    variant == 'primary',
            }"
        >
            <span><slot /></span>
            <svg xmlns="http://www.w3.org/2000/svg" class="ml-3 text-primary h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
            </svg>
        </a>
    </div>
</template>
<script>
export default {
    props: {
        variant: {
            type: String,
            default: "primary",
        },
        type: String,
        href: String,
    },
};
</script>

<style lang="scss" scoped>
    a.text-primary:hover svg,
    button.text-primary:hover svg {
        stroke:#FFFFFF !important;
    }
    a.text-white:hover svg,
    button.text-white:hover svg {
        stroke:#122C65 !important;
    }
</style>
