<script setup>
import {ref} from 'vue';
import { useForm,router} from '@inertiajs/vue3';
import axios from 'axios';
const props=defineProps({
    event:Object,
    idx:Number,
});


const editEvent=useForm({
    event:props.event.event,
    id:props.event.id,
});

let showInput=ref(false);

const save=()=>{
    editEvent.patch(`/event/${editEvent.id}`,{
        onSuccess:()=>{
            showInput=false;
            router.reload();
        }
    });
}
const del=(id)=>{
    axios.delete(`/event/${id}`)
    .then((res)=>{
        //console.log(res.data);
        router.reload();
    }).catch(err=>console.log(err));
}

</script>
<template>
    <div  class="w-full flex justify-between">
    <div v-if="!showInput">
    {{props.idx+1}}. {{props.event.event}}
    </div> 
    <div v-else="showInput">
    {{props.idx+1}}. <input type="text" v-model="editEvent.event"  class="border border-gray-500 p-2 mx-2">
    </div>
    <div>
      <button class="btn btn-yellow" v-if="!showInput"  @click="showInput=true">編輯</button>
      <button class="btn btn-blue" v-if="showInput" @click="save">更新</button>
      <button class="btn btn-red" @click="del(props.event.id)">刪除</button>
    </div>
    
    </div>
</template>
<style scoped>
.btn{
    @apply border  px-4 py-1 rounded-2xl drop-shadow-lg
}

.btn-yellow{
    @apply bg-yellow-800 text-yellow-100
}
.btn-red{
    @apply bg-red-200 text-red-800
}
.btn-blue{
    @apply bg-blue-200 text-blue-800
}
</style>