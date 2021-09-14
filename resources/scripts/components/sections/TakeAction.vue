<template>
    <SectionContainer containerClasses="min-h-screen flex flex-col justify-center">
        <h3 class="text-2xl tracking-widest font-black text-white">{{ title }}</h3>
        <div class="grid grid-cols-3 gap-8 mt-10">
            <ActionCard 
                v-for="(item, i) in ActionsData"
                :key="i"
                :title="item.title"
                :description="item.excerpt"
                :email="item.email"
                :label="label"
                :buttonLabel="buttonLabel"
                :body="item.content"
            ></ActionCard>
        </div>
    </SectionContainer>
</template>
<script>
export default {
    name: "TakeAction",
    props: {
        "ActionsData":Array,
        "title":{
            type:String,
            default:"Take Action",
        },
        "label":{
            type:String,
            default:"Action",
        },
        "buttonLabel":{
            type:String,
            default:"Email Now",
        }
    },
};
</script>
