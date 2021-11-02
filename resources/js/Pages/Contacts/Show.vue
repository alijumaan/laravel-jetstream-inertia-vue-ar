<template>
    <app-layout title="الرسائل">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                رسالة من  ({{ contact.name }})
            </h2>
        </template>
        <div class="justify-center items-center h-full">
            <div class="mx-6 my-20">
                <div class="card">
                    <div class="flex flex-col">
                        <div class="-my-2">
                            <div class="py-2 align-middle inline-block min-w-full">
                                <div class="border-b border-gray-200 sm:rounded-lg">
                                    <div class="text-center flex justify-between">
                                        <h6 class="text-blueGray-700 text-xl font-bold">
                                        </h6>
                                        <Link :href="route('contacts.index')">
                                            <jet-button class="mb-4">عودة</jet-button>
                                        </Link>
                                    </div>
                                    <table class="min-w-full divide-y divide-gray-200 text-right">
                                        <tbody class="divide-y divide-gray-200">
                                        <tr>
                                            <th scope="col" class="px-3 font-bold bg-gray-50 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                المرسل
                                            </th>
                                            <th scope="col" class="px-3 font-bold bg-gray-50 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                عنوان الرسالة
                                            </th>
                                        </tr>
                                        <tr>
                                            <td class="px-3 py-3 whitespace-nowrap">
                                                <div>
                                                    <div class="px-3 text-sm font-medium text-gray-900">
                                                        {{ contact.name }}
                                                    </div>
                                                    <div class="px-3 text-sm text-gray-500">
                                                        {{ contact.email }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-3 py-3 whitespace-nowrap">
                                                {{ contact.title }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th colspan="2" scope="col" class="px-3 font-bold bg-gray-50 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                المحتوى
                                            </th>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div>
                                        <p class="px-3 py-3" v-html="contact.body">
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import { defineComponent } from 'vue'
import AppLayout from "@/Layouts/AppLayout";
import JetButton from "@/Jetstream/Button";

export default defineComponent({
    components: {
        AppLayout,
        JetButton,
    },
    props: {
        contact: Object,
    },
})
</script>

<style scoped>
tr, td {
    font-size: 12px;
}
p {
    font-size: 14px;
}
</style>
