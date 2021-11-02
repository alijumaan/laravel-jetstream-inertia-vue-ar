<template>
    <app-layout title="Items">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                تعديل الصنف {{ item.nomenclature }}
            </h2>
        </template>
        <div class="flex justify-center items-center h-full overflow-auto">
            <div class="mx-3 my-20">
                <div class="card">
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class=" overflow-hidden sm:rounded-lg">
                                    <div class="lg:w-1/2 md:w-2/3 mx-auto">
                                        <div class="rounded-t mb-0 px-3 py-6">
                                            <div class="text-center flex justify-between">
                                                <h6 class="text-blueGray-700 text-xl font-bold">
                                                </h6>
                                                <Link :href="route('items.index')">
                                                    <jet-button >عودة الى الاصناف</jet-button>
                                                </Link>
                                            </div>
                                        </div>
                                        <form @submit.prevent="updateItem">
                                            <div class="flex flex-wrap -m-2">
                                                <div class="p-2 w-full">
                                                    <div class="relative">
                                                        <Label for="name" value="التسمية" />
                                                        <Input type="text" v-model="form.nomenclature" id="name" name="name" class="mt-1 block w-full " />
                                                        <jet-input-error :message="form.errors.nomenclature" class="mt-2" />
                                                    </div>
                                                </div>
                                                <div class="p-2 w-full">
                                                    <div class="relative">
                                                        <Label for="number" value="المعرف" />
                                                        <Input type="text" v-model="form.sku" id="number" name="number" class="mt-1 block w-full " />
                                                        <jet-input-error :message="form.errors.sku" class="mt-2" />
                                                    </div>
                                                </div>
                                                <div class="p-2 w-full">
                                                    <div class="relative">
                                                        <Label for="number" value="رقم التجزئة" />
                                                        <Input type="text" v-model="form.part" id="number" name="number" class="mt-1 block w-full " />
                                                        <jet-input-error :message="form.errors.part" class="mt-2" />
                                                    </div>
                                                </div>
                                                <div class="p-2 w-full">
                                                    <div class="relative">
                                                        <Label for="number" value="اللون" />
                                                        <Input type="text" v-model="form.color" id="number" name="number" class="mt-1 block w-full " />
                                                        <jet-input-error :message="form.errors.color" class="mt-2" />
                                                    </div>
                                                </div>
                                                <div class="p-2 w-full">
                                                    <div class="relative">
                                                        <Label for="number" value="المقاس" />
                                                        <Input type="text" v-model="form.size" id="number" name="number" class="mt-1 block w-full " />
                                                        <jet-input-error :message="form.errors.size" class="mt-2" />
                                                    </div>
                                                </div>
                                                <div class="p-2 w-full">
                                                    <div class="relative">
                                                        <Label for="number" value="الكمية" />
                                                        <Input type="text" v-model="form.quantity" id="number" name="number" class="mt-1 block w-full " />
                                                        <jet-input-error :message="form.errors.quantity" class="mt-2" />
                                                    </div>
                                                </div>
                                                <div class="p-2 w-full">
                                                    <div class="relative">
                                                        <Label for="status" value="الحالة" />
                                                        <select v-model="form.status" id="status" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full">
                                                            <option value="0">غير صالح</option>
                                                            <option value="1">صالح</option>
                                                        </select>
                                                    </div>
                                                    <jet-input-error :message="form.errors.status" class="mt-2" />
                                                </div>
                                                <div class="p-2 w-full">
                                                    <jet-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                                        تعديل
                                                    </jet-button>
                                                </div>
                                            </div>
                                        </form>
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
import AppLayout from "../../../Layouts/AppLayout";
import Label from "../../../Jetstream/Label";
import Input from "../../../Jetstream/Input";
import JetButton from "../../../Jetstream/Button";
import JetInputError from '@/Jetstream/InputError.vue'

export default defineComponent({
    components: {
        AppLayout,
        Label,
        Input,
        JetButton,
        JetInputError,
    },
    props: {
        item: Object
    },
    data() {
        return {
            form: this.$inertia.form({
                nomenclature: this.item.nomenclature,
                sku: this.item.sku,
                part: this.item.part,
                color: this.item.color,
                size: this.item.size,
                quantity: this.item.quantity,
                status: this.item.status
            }),
        }
    },
    methods: {
        updateItem() {
            this.form.put(route('items.update', this.item.id), {
                onSuccess: () => this.form.reset(),
            })
        },
    },
})
</script>

<style scoped></style>
