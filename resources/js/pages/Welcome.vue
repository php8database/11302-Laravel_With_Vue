<script setup>
import { Head, Link ,useForm,router} from '@inertiajs/vue3';
import { ref,reactive ,onBeforeMount} from 'vue';
import Event from '@/pages/Event.vue';

const props=defineProps({
    events:Array,
});

const event=ref('');

const createEvent=useForm({
    event:'',
});

const addEvent=()=>{
     createEvent.event=event.value;
     createEvent.post('/event',{
            onSuccess:()=>{
                event.value='';
            }
     });
}

/* const del=(id)=>{
    axios.delete(`/event/${id}`)
    .then((res)=>{
        //console.log(res.data);
        router.reload();
    }).catch(err=>console.log(err));
} */

</script>

<template>
    <Head title="待辦事項">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <div class="flex min-h-screen flex-col items-center bg-[#FDFDFC] p-6 text-[#1b1b18] dark:bg-[#0a0a0a] lg:justify-center lg:p-8">
        <header class="not-has-[nav]:hidden mb-3 w-full max-w-[335px] text-sm lg:max-w-4xl">
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
                        登入
                    </Link>
                    <Link
                        :href="route('register')"
                        class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                    >
                        註冊
                    </Link>
                </template>
            </nav>
        </header>
        <div class="duration-750 starting:opacity-0 flex w-full justify-center opacity-100 transition-opacity lg:grow">
            <main class="flex w-full max-w-[750px] content-start flex-wrap overflow-hidden rounded-lg">
            <div class="w-full  flex justify-center items-center p-4 bg-white rounded-lg">
                <label for="">工作事項</label>
                <input class="border border-gray-500 p-2 mx-2"
                        type="text" name="event" id="event"
                        v-model="event">
                <button class="btn btn-lime "
                        @click="addEvent">
                    新增
                </button>
            </div>
            <h3 class='text-center w-full text-2xl '>待辦事項清單</h3>
            <div id="lists" class="w-full p-4">
                <Event v-for="event,idx in props.events" 
                        :key="idx" 
                        :idx="idx"  
                        :event="event" 
                        @del="del"/>
            </div>
            </main>
        </div>
        <div class="h-14.5 hidden lg:block"></div>
    </div>
</template>
<style scoped>
.btn{
    @apply border  px-4 py-1 rounded-2xl drop-shadow-lg
}

.btn-lime{
    @apply bg-lime-200 text-lime-800
}

</style>
