<template>
    <SectionContainer containerClasses="min-h-screen flex flex-col justify-center py-20">
        <template slot="beforeContainer">
            <img class="section-bg" :src="$images + '/updates-bg.png'" alt="" />
        </template>
        <h4 class="font-black text-2xl md:text-4xl text-white tracking-wider">
            Press Releases and Updates
        </h4>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-14">
            <UpdatesCard></UpdatesCard>
            <UpdatesCard></UpdatesCard>
            <UpdatesCard></UpdatesCard>
        </div>
    </SectionContainer>
</template>
<style lang="scss" scoped>
.section-bg {
    @apply absolute w-full h-full object-cover top-0 left-0 z-0;
}
</style>
