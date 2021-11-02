<template>
    <app-layout title="Buildings">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                المستخدمين
            </h2>
        </template>
        <div v-if="$page.props.is_admin" class="justify-center items-center h-full">
            <div class="my-20">
                <div class="card">
                    <div class="px-3 text-center flex justify-between">
                        <h6 class="text-blueGray-700 text-xl font-bold">
                            <Link :href="route('users.create')">
                                <jet-button class="mb-4">انشاء مستخدم</jet-button>
                            </Link>
                        </h6>
                        <Link :href="route('supplies.index')">
                            <jet-button class="mb-4">عودة</jet-button>
                        </Link>
                    </div>
                    <div class="flex flex-col">
                        <div class="px-3 overflow-x-auto">
                            <div class="py-2 align-middle inline-block min-w-full">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table class="min-w-full divide-y text-right divide-gray-200">
                                        <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                ID الاسم & الإيميل
                                            </th>
                                            <th scope="col" class="text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                الوظيفة
                                            </th>
                                            <th scope="col" class="text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                تاريخ التسجيل
                                            </th>
                                            <th scope="col" class="text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                الإجراء
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                        <tr v-if="users.data.length > 0" v-for="(user, index) in users.data" :key="user.id">
                                            <td class="py-2 whitespace-nowrap">
                                                <div class="pr-2 flex items-center">
                                                    <div>
                                                        <div class="text-xs font-medium text-gray-900">
                                                            {{ user.id }} - {{ user.name }} <br>
                                                            <span class="text-red-800">{{ user.username }}</span>
                                                        </div>
                                                        <div class="text-xs text-gray-500">
                                                            {{ user.email }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="whitespace-nowrap">
                                              <span class="inline-flex text-xs leading-5 font-semibold rounded-full">
                                                  {{ user.role }}
                                              </span>
                                            </td>
                                            <td class="whitespace-nowrap">
                                              <span class="inline-flex text-xs leading-5 font-semibold rounded-full">
                                                {{ user.created_at }}
                                              </span>
                                            </td>
                                            <td class="whitespace-nowrap text-center text-xs font-medium justify-between">
                                                <Link :href="route('users.edit', user.id)" class="text-indigo-600 hover:text-indigo-900">
                                                    <i class="fa fa-edit"></i>
                                                </Link>
                                                <button @click="deleteUser(user.id)" class="text-red-700 hover:text-indigo-900">
                                                    <i class="fa fa-trash mr-3"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr v-else>
                                            <td colspan="4" class=" py-3 text-center">لايوجد مستخدمين</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="users.total > pagination" class="mt-4">
                    <div class="flex items-center">
                        <template v-for="(link, key) in users.links">
                            <div v-if="link.url === null" :key="key"
                                 class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded"
                                 v-html="link.label" :class="{ 'bg-white': link.active }"/>
                            <Link v-else class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500"
                                  :class="{ 'bg-white': link.active }" :href="link.url" v-html="link.label" />
                        </template>
                    </div>
                </div>
            </div>

            <div class="mx-3 my-20">
                <div class="card">
                    <div class="text-center flex justify-between">
                        <h6 class="mb-4 text-red-900 text-xl font-bold">
                            المستخدمين الغير فعالين
                        </h6>
                    </div>
                    <div class="flex flex-col">
                        <div class="px-3 overflow-x-auto">
                            <div class="py-2 align-middle inline-block min-w-full">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table class="min-w-full divide-y text-right divide-gray-200">
                                        <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                ID الاسم & الإيميل
                                            </th>
                                            <th scope="col" class="text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                الوظيفة
                                            </th>
                                            <th scope="col" class="text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                تاريخ التسجيل
                                            </th>
                                            <th scope="col" class="text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                الإجراء
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                        <tr v-if="inactiveUsers.data.length > 0" v-for="(user, index) in inactiveUsers.data" :key="user.id">
                                            <td class="py-2 whitespace-nowrap">
                                                <div class="pr-2 flex items-center">
                                                    <div>
                                                        <div class="text-xs font-medium text-gray-900">
                                                            {{ user.id }} - {{ user.name }} <br>
                                                            <span class="text-red-800">{{ user.username }}</span>
                                                        </div>
                                                        <div class="text-xs text-gray-500">
                                                            {{ user.email }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="whitespace-nowrap">
                                              <span class="inline-flex text-xs leading-5 font-semibold rounded-full">
                                                  {{ user.role }}
                                              </span>
                                            </td>
                                            <td class="whitespace-nowrap">
                                              <span class="inline-flex text-xs leading-5 font-semibold rounded-full">
                                                {{ user.created_at }}
                                              </span>
                                            </td>
                                            <td class="whitespace-nowrap text-center text-xs font-medium justify-between">
                                                <button @click="restore(user.id)" class="hover:text-indigo-900">
                                                    <i class="fas fa-trash-restore"></i>
                                                </button>
                                                <button @click="forceDeleteUser(user.id)" class="text-red-700 hover:text-indigo-900">
                                                    <i class="fa fa-trash mr-3"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr v-else>
                                            <td colspan="5" class=" py-3 text-center">لا يوجد مستخدمين غير فعالين</td>
                                        </tr>
                                        </tbody>
                                    </table>
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
            users: Object,
            inactiveUsers: Object,
            pagination: Number
        },
        methods: {
            deleteUser(userId) {
                if(confirm("هل انت متاكد من حذف المستخدم؟")) {
                    axios.delete(`users/${userId}`).then(response => {
                        return this.$inertia.get('users');
                    });
                }
                return false;
            },

            restore(userId) {
                if(confirm("هل انت متاكد من استعادة المستخدم؟")) {
                    axios.post(`users/${userId}/restore`).then(response => {
                        return this.$inertia.get('users');
                    })
                }
                return false;
            },

            forceDeleteUser(userId) {
                if(confirm("حذف المستخدم نهائياً، هل انت متأكد؟")) {
                    axios.delete(`users/${userId}/force-delete`).then(response => {
                        return this.$inertia.get('users');
                    })
                }
                return false;
            }
        }

    })
</script>

<style scoped>
table, thead, tbody, th, td, tr {
    padding: 5px 0 5px 0;
    margin: 0;
    font-size: 12px;
}
</style>
