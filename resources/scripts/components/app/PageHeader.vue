<template>
    <section class="page-header-section w-full bg-gradient-to-b from-primary to-secondary relative overflow-hidden flex items-center py-20" ref="section">
        <img ref="image" :src="imageUrl?imageUrl:$images+'/header.png'" class="img" alt="" />
        <div class="content-title" ref="contentTitle">
            <slot />
        </div>
    </section>
</template>

<script>
export default {
    props:{
        imageUrl:{
            type:String,
            default:null,
        }
    }
}
</script>
<style lang="scss" scoped>
.page-header-section {
    height:312px;
}

.img {
    @apply absolute h-full w-screen z-10 object-cover object-center;
}

.content-title {
    @apply relative z-20 container;
}

.content-title h1 {
    @apply text-white font-bold font-display text-4xl;
}
</style>
