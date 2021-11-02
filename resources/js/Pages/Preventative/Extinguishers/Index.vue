<template>
    <app-layout title="الطفايات">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                الطفايات
            </h2>
        </template>
        <div class="justify-center items-center h-full">
            <div class="mx-3 my-20">
                <div class="card">

                    <pull-up-extinguisher-form :extinguishers="extinguishers" :buildings="buildings"/>

                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200 text-right">
                                        <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                النوع
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                العدد
                                            </th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody  class="bg-white divide-y divide-gray-200">
                                        <tr v-if="extinguishers.data.length > 0" v-for="(extinguisher, index) in extinguishers.data" :key="extinguisher.id">
                                            <td class="px-6 py-3 whitespace-nowrap">
                                                {{ extinguisher.type }}
                                            </td>
                                            <td class="px-6 py-3 whitespace-nowrap">
                                                {{ extinguisher.extinguisherCount }}
                                            </td>
                                            <td class="py-3 whitespace-nowrap">
                                                <Link :href="route('extinguishers.show', extinguisher.slug)" >
                                                  <button class="text-blue-800">التفاصيل</button>
                                                </Link>
                                            </td>
                                        </tr>
                                        <tr v-else>
                                            <td colspan="4" class="px-6 py-3 text-center">لاتوجد طفايات</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="extinguishers.total > pagination" class="mt-4">
                    <div class="flex items-center">
                        <template v-for="(link, key) in extinguishers.links">
                            <div v-if="link.url === null" :key="key"
                                 class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded"
                                 v-html="link.label" :class="{ 'bg-white': link.active }"/>
                            <Link v-else class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500"
                                  :class="{ 'bg-white': link.active }" :href="link.url" v-html="link.label" />
                        </template>
                    </div>
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
import PullUpExtinguisherForm from '@/Pages/Preventative/Extinguishers/Partials/PullUpExtinguisherForm.vue'

export default defineComponent({
    components: {
        AppLayout,
        JetButton,
        PullUpExtinguisherForm,
        Head,
    },
    props: {
        extinguishers: Object,
        buildings: Object,
        pagination: Number,
    },

})
</script>

<style scoped></style>
