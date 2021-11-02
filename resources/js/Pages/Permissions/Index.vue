<template>
    <app-layout title="الصلاحيات">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                الصلاحيات
            </h2>
        </template>
        <div class="justify-center items-center h-full">
            <div class="mx-3 my-20">
                <div class="card">
                    <create-permission-form />
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200 text-right">
                                        <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                الصلاحية
                                            </th>
                                            <th></th>
                                            <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                الإجراء
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody  class="bg-white divide-y divide-gray-200">
                                        <tr v-if="permissions.data.length > 0" v-for="(permission, index) in permissions.data" :key="permission.id">
                                            <td class="px-6 py-3 whitespace-nowrap">
                                                {{ permission.name }}
                                            </td>
                                            <td class="whitespace-nowrap text-center text-sm font-medium justify-between">

                                                <update-permission-form :permission="permission"/>

                                            </td>
                                            <td class="whitespace-nowrap text-center text-sm font-medium justify-between">

                                                <delete-permission-form :permissionName="permission.name" :permissionId="permission.id" />

                                            </td>
                                        </tr>
                                        <tr v-else>
                                            <td colspan="4" class="px-6 py-3 text-center">لاتوجد صلاحيات</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex items-center">
                        <template v-if="permissions.total > pagination" v-for="(link, key) in permissions.links">
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
import JetActionSection from '@/Jetstream/ActionSection.vue'
import JetDialogModal from '@/Jetstream/DialogModal.vue'
import JetDangerButton from '@/Jetstream/DangerButton.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetInputError from '@/Jetstream/InputError.vue'
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'
import JetButton from "@/Jetstream/Button";
import CreatePermissionForm from "@/Pages/Permissions/Partials/CreatePermissionForm.vue"
import UpdatePermissionForm from "@/Pages/Permissions/Partials/UpdatePermissionForm.vue"
import DeletePermissionForm from "@/Pages/Permissions/Partials/DeletePermissionForm.vue"

export default defineComponent({
    components: {
        AppLayout,
        JetButton,
        JetActionSection,
        JetDangerButton,
        JetSecondaryButton,
        JetDialogModal,
        JetInput,
        JetInputError,
        CreatePermissionForm,
        UpdatePermissionForm,
        DeletePermissionForm,
        Head,
    },
    props: {
        permissions: Object,
        pagination: Number,
    }
})
</script>

<style scoped></style>
