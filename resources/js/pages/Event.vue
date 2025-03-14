<script setup>
import {ref} from 'vue';
import { useForm} from '@inertiajs/vue3';
const props=defineProps({
    event:Object,
    idx:Number,
});

const editEvent=useForm({
    event:props.event.event,
});

let showInput=ref(false);

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
      <button class="btn btn-yellow" v-if="!showInput"  @click="edit(idx)">編輯</button>
      <button class="btn btn-blue" v-if="showInput" @click="save(props.event.id)">更新</button>
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