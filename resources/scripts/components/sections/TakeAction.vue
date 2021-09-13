<template>
    <SectionContainer containerClasses="min-h-screen flex flex-col justify-center">
        <h3 class="text-2xl tracking-widest font-black text-white">Take Action</h3>
        <div class="grid grid-cols-3 gap-8 mt-10">
            <ActionCard></ActionCard>
            <ActionCard></ActionCard>
            <ActionCard></ActionCard>
        </div>
    </SectionContainer>
</template>
<script>
export default {
    name: "TakeAction",
};
</script>
