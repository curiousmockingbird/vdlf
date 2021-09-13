<template>
    <SectionContainer containerClasses="min-h-screen flex flex-col justify-center py-20">
        <template slot="beforeContainer">
            <img :src="$images + '/services-circles.png'" class="bg-circle z-0" />
        </template>
        <h4 class="font-black text-xl md:text-4xl text-black tracking-wider">Services</h4>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mt-14">
            <ServiceCard background="#397894"></ServiceCard>
            <ServiceCard background="#357C4C"></ServiceCard>
            <ServiceCard background="#871D3D"></ServiceCard>
            <ServiceCard background="#A0643D"></ServiceCard>
            <ServiceCard background="#C63973"></ServiceCard>
            <ServiceCard background="#D09468"></ServiceCard>
        </div>
    </SectionContainer>
</template>
<style lang="scss" scoped>
.bg-circle {
    position: absolute;
    right: -200px;
    top: 150px;
    transform: translateY(-50%);
}
</style>
