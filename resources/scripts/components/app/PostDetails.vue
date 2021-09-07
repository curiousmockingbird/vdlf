<template>
    <div class="post-detials">
        <p class="text-secondaryPinot-500 font-semibold py-3">By {{ author }}</p>
        <p>
            {{ excerpt }}
        </p>
        <div class="flex justify-between mt-3">
            <a :href="moreUrl" class="text-secondaryPinot-500 font-semibold text-sm">{{
                moreString
            }}</a>
            <span class="font-semibold text-black-100 text-sm">{{ date }}</span>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        author: {
            type: String,
            default: "Sharisse Tracey",
        },
        excerpt: {
            type: String,
            default:
                "As the mother of four, currently with two school-aged children attending public school remotely, I can’t help but reflect on a time when I was completely reliant on child care...",
        },
        moreString: {
            type: String,
            default: "Read More",
        },
        moreUrl: {
            type: String,
            default: "#",
        },
        date: {
            type: String,
            default: "15min ago",
        },
    },
};
</script>
