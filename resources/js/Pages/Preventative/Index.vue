<template>
    <app-layout title="الوقاية">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                الوقاية
            </h2>
        </template>
        <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="text-center flex justify-center">
                <h6 class="text-blueGray-700 text-xl font-bold">

                </h6>
                <Link :href="route('dashboard')">
                    <jet-button class="mb-4">الرئيسية</jet-button>
                </Link>
            </div>
            <div class="flex justify-center items-center h-full overflow-auto">
                <div class="p-6 grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                    <!-- Start Building -->
                    <div class="bg-blue-600 pt-1 px-2 bg-gradient-to-b from-blue-400 to-blue-500 rounded-xl shadow-lg w-52">
                        <Link :href="route('buildings.index')">
                            <div class="flex justify-center">
                                <div class="flex justify-center p-4 bg-blue-400 ring-2 ring-blue-300 rounded-lg shadow-xl w-32" >
                                    <i class="fas fa-store text-white text-2xl"></i>
                                </div>
                            </div>
                            <div class="p-4">
                                <p class="text-white font-semibold" >المباني</p>
                                <div class="flex justify-between mt-2">
                                    <p class="text-gray-200">عدد المباني</p>
                                    <p class="text-white" >{{ buildings_count }}</p>
                                </div>
                            </div>
                        </Link>
                    </div>
                    <!-- End Building -->

                    <!-- Start Extinguisher -->
                    <div class="bg-blue-600 pt-1 px-2 bg-gradient-to-b from-yellow-300 to-yellow-400 rounded-xl shadow-lg w-52">
                        <Link :href="route('extinguishers.index')">
                            <div class="flex justify-center">
                                <div class="flex justify-center p-4 bg-yellow-300 ring-2 ring-yellow-100 rounded-lg shadow-xl w-32" >
                                    <i class="fas fa-fire-extinguisher text-white text-2xl"></i>
                                </div>
                            </div>
                            <div class="p-4">
                                <p class="text-white font-semibold" >الطفايات</p>
                                <div class="flex justify-between mt-2">
                                    <p class="text-gray-200">انواع الطفايات</p>
                                    <p class="text-white" >{{ extinguishers_count }}</p>
                                </div>
                            </div>
                        </Link>
                    </div>
                    <!--End Extinguisher -->
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from "@/Layouts/AppLayout";
    import JetButton from "@/Jetstream/Button"

    export default defineComponent({
        components: {
            AppLayout,
            JetButton,
        },
        props: [
            'buildings_count',
            'extinguishers_count'
        ]
    })
</script>

<style scoped></style>
