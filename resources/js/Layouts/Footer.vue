<template>
    <!-- footer + newsletter ============================== -->
    <div class="p-10 bg-black text-indigo-400 flex justify-between">

        <!--   right -->
        <div class="bg-black md:w-1/2">
            <h3 class="bg-black text-lg mb-2">Join the Newsletter</h3>
            <form class="flex">
                <input type="email" class="w-full rounded-l py-3 px-4 outline-none focus:bg-gray-200">
                <button class="bg-red-300 hover:bg-red-400 text-red-800 rounded-r px-4">Join</button>
            </form>
        </div>

        <!--   right -->
        <div class="bg-black flex items-center">
            Copyright &copy; Doggos 2020 - Infinity
        </div>
    </div>
    <!-- BUY ME A BEER AND HELP SUPPORT OPEN-SOURCE RESOURCES -->
    <div class="flex items-end justify-end fixed bottom-0 right-0 mb-4 mr-4 z-10">
        <div>
            <a title="Contact" href="https://alialqahtani.sa" target="_blank" class="block w-16 h-16 rounded-full transition-all shadow hover:shadow-lg transform hover:scale-110 hover:rotate-12">
                <img class="object-cover object-center w-full h-full rounded-full" src="https://i.pinimg.com/originals/60/fd/e8/60fde811b6be57094e0abc69d9c2622a.jpg"/>
            </a>
        </div>
    </div>
</template>

<script>
    import { defineComponent } from 'vue'
    export default defineComponent({
    })
</script>

<style></style>
