<template>
    <section class="page-header-section w-full relative overflow-hidden flex items-center py-20" ref="section">
        <img ref="image" :src="imageUrl?imageUrl:$images+'/header.jpeg'" class="img" alt="" />
        <div class="content-title" ref="contentTitle">
            <slot />
        </div>
    </section>
</template>
<style lang="scss" scoped>
.page-header-section {
    @screen md {
        height:200px;
    }
    height:220px;
}

.img {
    @apply absolute h-full w-screen z-10 object-cover;
    object-position: 0px 0px;
    @screen md {
        object-position: top center;
    }
    @screen xl {
        object-position: 0px -148px;
    }
}

.content-title {
    @apply relative z-20;
    margin: 0px 0px 0px 0px;
    @screen md {
        padding: 20px 50px 20px 50px;
        @apply min-w-half;
    }
    padding: 17px 20px 20px 20px;
    background-color: #FFFFFFDE;
    min-width: calc(100% - 70px);
}

.content-title h2 {
    @apply text-primary font-semibold;
    line-height: 1.2em;
    letter-spacing: 1.2px;
    @screen md {
        font-size: 29px;
    }
    font-size: 24px;
}
</style>
