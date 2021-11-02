<template>
    <app-layout title="Extinguishers">
            <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    طفاية ({{ extinguisher.data.type }})
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
                                            <Link :href="route('extinguishers.index')">
                                                <jet-button class="mb-4">عودة</jet-button>
                                            </Link>
                                        </div>
                                        <table class="min-w-full divide-y divide-gray-200 text-right">
                                            <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class=" py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    النوع
                                                </th>
                                                <th scope="col" class="py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    العدد
                                                </th>
                                                <th scope="col" class="py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    المبنى
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                            <tr>
                                                <td class=" py-3 whitespace-nowrap">
                                                    {{ extinguisher.data.type }}
                                                </td>
                                                <td class="py-3 whitespace-nowrap">
                                                    {{ extinguisher.data.extinguisherCount }}
                                                </td>
                                                <td class="py-3 whitespace-nowrap">
                                                    <span v-if="buildings.length > 0" v-for="building in buildings">
                                                        {{ building.name }}

                                                        <return-extinguisher-to-building
                                                            :extinguisherId="extinguisher.data.id"
                                                            :buildingId="building.id"
                                                            :buildingName="building.name"
                                                        />
                                                    </span>
                                                    <span v-else >
                                                        لاتوجد مباني مسحوب طفاياتها
                                                    </span>
                                                </td>
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
    import JetButton from "@/Jetstream/Button";
    import JetDangerButton from "@/Jetstream/DangerButton"
    import ReturnExtinguisherToBuilding from "@/Pages/Preventative/Extinguishers/Partials/ReturnExtinguisherToBuilding";

    export default defineComponent({
        components: {
            ReturnExtinguisherToBuilding,
            AppLayout,
            JetButton,
            JetDangerButton,
            Head,
        },
        props: {
            extinguisher: Object,
            buildings: Object,
        },
        data() {
            return {

            }
        },
        methods: {
            returnExtinguisherToBuilding(extinguisherId, buildingId, buildingName) {
                if(confirm(`هل انت متاكد ارجاع الطفاية لمبنى (${buildingName})`)) {
                    axios.delete(`/extinguishers/${extinguisherId}/${buildingId}`).then(response => {
                        return this.$inertia.reload()
                    })
                }
                return false;
            }
        }
    })
</script>

<style scoped>
table, thead, tbody, tr, td, th, .btn-sm {
    font-size: 12px;
}
.btn-sm {
    padding: 4px;
    margin: 4px;
    font-size: 10px;
}
</style>
