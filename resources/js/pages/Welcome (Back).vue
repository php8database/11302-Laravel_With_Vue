<script setup>
import { Head, Link , useForm,router } from '@inertiajs/vue3';
import axios from 'axios';
import { ref , reactive ,onBeforeMount} from 'vue';


const props=defineProps({events:Array});
//let text=ref("");
const form=useForm({
    event:"",

});
const editText=useForm({
    event:"",
    id:0,
});
let showEdit=reactive(new Array());
//let lists=reactive(new Array());
const addEvent=()=>{
    //lists.push(form.event);
    
    form.post(route('store'),{
        onSuccess:()=>form.event="",
    });
    
    //console.log(lists);
}

const del=(idx,id)=>{
   // lists.splice(idx,1);
   axios.post(route('destroy',{id}))
        .then((res)=>{
            router.reload();
   });
}

const edit=(idx,id)=>{
    if(showEdit.indexOf(true)==-1){
        editText.event=props.events[idx].event;
        editText.id=id;
        showEdit[idx]=true;
    }else{
        alert("請先完成編輯");
    }
}
const save=(idx,id)=>{
   editText.post(route('update',id),{
       onSuccess:()=>{
           showEdit[idx]=false;
           router.reload();
       }
   });
   // showEdit[idx]=false;
}
const cancel=(idx)=>{
    editText.event='';
   showEdit[idx]=false;
}

onBeforeMount(()=>{
    props.events.forEach((item)=>{
        showEdit.push(false);
    });
});
</script>

<template>
    <Head title="Welcome">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <div class="flex min-h-screen flex-col items-center bg-[#FDFDFC] p-6 text-[#1b1b18] dark:bg-[#0a0a0a] lg:justify-center lg:p-8">
        <header class="not-has-[nav]:hidden mb-6 w-full max-w-[335px] text-sm lg:max-w-4xl">
            <nav class="flex items-center justify-end gap-4">
                <Link
                    v-if="$page.props.auth.user"
                    :href="route('dashboard')"
                    class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                >
                    Dashboard
                </Link>
                <template v-else>
                    <Link
                        :href="route('login')"
                        class="inline-block rounded-sm border border-transparent px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#19140035] dark:text-[#EDEDEC] dark:hover:border-[#3E3E3A]"
                    >
                        Log in
                    </Link>
                    <Link
                        :href="route('register')"
                        class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                    >
                        Register
                    </Link>
                </template>
            </nav>
        </header>
        <div class="duration-750 starting:opacity-0 flex w-full items-center justify-center opacity-100 transition-opacity lg:grow">
            <main class="flex w-full max-w-[335px] flex-col-reverse overflow-hidden rounded-lg lg:max-w-4xl lg:flex-row flex-wrap">
            <div class="w-full">
                <label for="">待辦事項</label>
                <input type="text" v-model="form.event" class="border px-3 py-3 rounded-lg ">
                <button class="btn btn-add"
                       @click="addEvent"
                      >
                        新增
                </button>
            </div>
            <div class="list w-1/2">
                <p v-for="item,idx in events" :key="idx" class="flex justify-between items-center border-b-2 py-2">
                <span>
                    <span v-if="!showEdit[idx]">{{ item.event }}</span>
                    <input type="text" v-model="editText.event" class="p-3 rounded-lg border bg-yellow-100"
                           v-if="showEdit[idx]">
                </span>
                <div v-if="!showEdit[idx]">
                <!-- <div> -->
                    <button class="btn btn-edit" @click="edit(idx,item.id)">編輯</button>
                    <button class="btn btn-del" @click="del(idx,item.id)">刪除</button>
                </div>
                <div v-else>
                    <button class="btn btn-save" @click="save(idx,item.id)">更新</button>
                    <button class="btn btn-cancel" @click="cancel(idx)">取消</button>
                </div>
                </p>
            </div>
            </main>
        </div>
        <div class="h-14.5 hidden lg:block"></div>
    </div>
</template>
<style scoped>
.btn{
    @apply border-2 px-3 py-1 rounded-lg drop-shadow-md
}
.btn-add{
    @apply bg-green-400 text-green-800 hover:bg-green-800 hover:text-green-200
}
.btn-edit{
    @apply bg-blue-400 text-blue-800 hover:bg-blue-800 hover:text-blue-200
}
.btn-del{
    @apply bg-red-400 text-red-800 hover:bg-red-800 hover:text-red-200
}
.btn-save{
    @apply bg-orange-300 text-orange-800 hover:bg-orange-800 hover:text-orange-200
}
.btn-cancel{
    @apply bg-gray-300 text-gray-800 hover:bg-gray-800 hover:text-gray-300
}
</style>
