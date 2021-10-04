<template>
    <div class="content-media w-full overflow-hidden rounded-lg">
        <img :src="media" class="object-cover w-full h-96" />
    </div>
</template>
<script>
export default {
    props: ["media"],
};
</script>