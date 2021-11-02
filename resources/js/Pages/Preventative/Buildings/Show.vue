<template>
    <app-layout title="Buildings">
            <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    مبنى {{ building.name }} ({{ building.number }})
                </h2>
            </template>
            <div class="justify-center items-center h-full">
                <div class="mx-3 my-20">
                    <div class="card">
                        <div class="flex flex-col">
                            <div class="-my-2 overflow-x-auto">
                                <div class="py-2 align-middle inline-block min-w-full">
                                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                        <div class="text-center flex justify-between">
                                            <h6 class="text-blueGray-700 text-xl font-bold">
                                            </h6>
                                            <Link :href="route('buildings.index')">
                                                <jet-button class="mb-4">عودة</jet-button>
                                            </Link>
                                        </div>
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    المبنى
                                                </th>
                                                <th scope="col" class="py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    المفتش
                                                </th>
                                                <th scope="col" class="py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    تاريخ الانتهاء
                                                </th>
                                                <th scope="col" class="py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    الحالة
                                                </th>
                                                <th colspan="2" class="text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    <span class="">الاجراءات</span>
                                                </th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                            <tr>
                                                <td class="py-2 whitespace-nowrap text-center">
                                                    <div class="ml-4">
                                                        <div class="text-xs font-medium text-gray-900">
                                                            {{ building.name }}
                                                        </div>
                                                        <div class="text-xs text-gray-500">
                                                            {{ building.number }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="py-2 whitespace-nowrap text-center">
                                                    <div class="ml-4">
                                                        <div class="text-xs font-medium text-gray-900">
                                                            {{ building.inspector }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="whitespace-nowrap text-center">
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900">
                                                        <span :class="new Date(building.checked_at ).getTime() > new Date().getTime()
                                                                ? ' inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800'
                                                                : ' inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800'">
                                                            {{ building.checked_at }}
                                                        </span>
                                                        </div>
                                                        <div :class="new Date(building.checked_at ).getTime() > new Date().getTime()
                                                                 ? 'text-small text-green-500'
                                                                 :  'text-small text-red-500'">
                                                            <span class="">{{ new Date(building.checked_at ).getTime() > new Date().getTime() ? 'باقي له ' : 'منتهي '}}</span>
                                                            <span class="">{{ building.checked_at_string }}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="whitespace-nowrap text-center">
                                              <span :class="building.status === 0
                                                        ? ' inline-flex text-small leading-5 font-semibold rounded-full bg-red-100 text-red-800'
                                                        : ' inline-flex text-small leading-5 font-semibold rounded-full bg-green-100 text-green-800'">
                                                {{ building.status === 0 ? 'منتهي' : 'مشيك' }}
                                              </span>
                                                </td>
                                                <td class="whitespace-nowrap text-center text-sm font-medium justify-between">
                                                    <update-building-form :building="building" :periods="periods"  :users="users"/>
                                                </td>
                                                <td class="whitespace-nowrap text-center text-sm font-medium justify-between">
                                                    <delete-building-form :buildingName="building.name" :buildingSlug="building.slug"/>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="mt-3">
                                        <h6>الملاحظات</h6>
                                        <p>{{ building.notes}}</p>
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
    import UpdateBuildingForm from "@/Pages/Preventative/Buildings/Partials/UpdateBuildingForm";
    import DeleteBuildingForm from "@/Pages/Preventative/Buildings/Partials/DeleteBuildingForm";

    export default defineComponent({
        components: {
            AppLayout,
            UpdateBuildingForm,
            DeleteBuildingForm,
            JetButton,
            Head,
        },
        props: {
            building: Object,
            periods: Object,
            users: Object
        },
    })
</script>

<style scoped>
table, thead, tbody, tr, td, th {
    font-size: 12px;
}
.text-small {
    font-size: 10px;
}
</style>
