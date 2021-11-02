<template>
    <app-layout title="الأدوار">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                الأدوار
            </h2>
        </template>

        <div class="justify-center items-center h-full">
            <div class="mx-3 my-20">
                <div class="card">

                    <create-role-form :permissions=permissions class="mt-10 sm:mt-0" />

                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200 text-right">
                                        <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                ID
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                الاسم
                                            </th>
                                            <th></th>
                                            <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                <span class="">الاجراءات</span>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody  class="bg-white divide-y divide-gray-200">
                                        <tr v-if="roles.data.length > 0" v-for="(role, index) in roles.data" :key="role.id">
                                            <td class="px-6 py-3 text-center whitespace-nowrap">
                                                {{ role.id }}
                                            </td>
                                            <td class="px-6 py-3 text-center whitespace-nowrap">
                                                {{ role.name }}
                                            </td>
                                            <td class="py-3 text-center whitespace-nowrap">
                                                <update-role-form :role="role" :permissions="permissions"/>
                                            </td>
                                            <td class="py-3 text-center whitespace-nowrap">
                                                <delete-role-form :roleId="role.id" :roleName="role.name" />
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
                        <template v-if="roles.total > pagination" v-for="(link, key) in roles.links">
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
import AppLayout from "@/Layouts/AppLayout";
import JetButton from "@/Jetstream/Button";
import CreateRoleForm from '@/Pages/Roles/Partials/CreateRoleForm.vue'
import UpdateRoleForm from "@/Pages/Roles/Partials/UpdateRoleForm";
import DeleteRoleForm from "@/Pages/Roles/Partials/DeleteRoleForm";

export default defineComponent({
    components: {
        AppLayout,
        JetButton,
        CreateRoleForm,
        UpdateRoleForm,
        DeleteRoleForm,
    },
    props: {
        roles: Object,
        pagination: Number,
        permissions: Object
    },
})
</script>

<style scoped></style>
