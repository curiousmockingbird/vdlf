<template>
    <img :src="$images + '/' + src" :alt="alt" :height="height" :width="width" />
</template>
<script>
export default {
    props: {
        src: String,
        local: Boolean,
        alt: String,
        height: String,
        width: String,
    },
};
</script>
