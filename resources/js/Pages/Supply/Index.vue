<template>
    <app-layout title="التموين">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                الاصناف
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
                    <!-- start product -->
                    <div class="bg-red-600 pt-1 px-2 bg-gradient-to-b from-red-400 to-red-500 rounded-xl shadow-lg w-52">
                        <Link :href="route('items.index')">
                            <div class="flex justify-center">
                                <div class="flex justify-center p-4 bg-red-400 ring-2 ring-red-300 rounded-lg shadow-xl w-32" >
                                    <i class="fas fa-store text-white text-2xl"></i>
                                </div>
                            </div>
                            <div class="p-4">
                                <p class="text-white font-semibold" >الأصناف</p>
                                <div class="flex justify-between mt-2">
                                    <p class="text-gray-200">عدد الاصناف</p>
                                    <p class="text-white" >1000</p>
                                </div>
                            </div>
                        </Link>
                    </div>
                    <!-- end product -->

                    <!-- new section -->

                    <!-- end section -->
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Head } from '@inertiajs/inertia-vue3';
    import AppLayout from "@/Layouts/AppLayout";
    import JetButton from "@/Jetstream/Button"

    export default defineComponent({
        components: {
            AppLayout,
            JetButton,
            Head,
        },

        props: {

        }
    })
</script>

<style scoped></style>
