<template>
    <app-layout title="الصلاحيات">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                رسائل التواصل
            </h2>
        </template>
        <div v-if="!$page.props.is_admin" class="mx-6 my-20">
            <div class="mx-6 flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <form @submit.prevent="saveContact">
                            <div>
                                <jet-label class="my-3" for="name" value="الاسم" />
                                <jet-input id="name" ref="name" type="text" class="mt-1 block w-full" v-model="form.name" autofocus autocomplete="name" />
                                <jet-input-error :message="form.errors.name" class="mt-2" />
                            </div>
                            <div>
                                <jet-label class="my-3" for="title" value="عنوان الرسالة" />
                                <jet-input id="title" ref="title" type="text" class="mt-1 block w-full" v-model="form.title" autofocus autocomplete="title" />
                                <jet-input-error :message="form.errors.title" class="mt-2" />
                            </div>
                            <div>
                                <jet-label class="my-3" for="title" value="عنوان الرسالة" />
                                <textarea v-model="form.body" rows="10" class="mt-1 block w-full"></textarea>
                                <jet-input-error :message="form.errors.body" class="mt-2" />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <jet-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    ارسال
                                </jet-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="$page.props.is_admin" class="justify-center items-center h-full">
            <div class="mx-6 my-20">
                <div class="card">
                    <div class="flex flex-col">
                        <div class="py-2 align-middle inline-block sm:px-6 lg:px-8">
                            <div class="shadow border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200 text-center">
                                    <thead class="bg-gray-50">
                                    <tr>
                                        <th class="py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            المرسل
                                        </th>
                                        <th class="py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            عنوان الرسالة
                                        </th>
                                        <th class="py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            الحالة
                                        </th>
                                        <th class="py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            التاريخ
                                        </th>
                                        <th class="text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            الاجراء
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody  class="bg-white divide-y divide-gray-200">
                                    <tr v-if="contacts.length > 0" v-for="(contact, index) in contacts" :key="contact.id">
                                        <td class="whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">
                                                <Link :href="route('contacts.show', contact.id)" class="text-indigo-600 hover:text-indigo-900">
                                                    {{ contact.name }}
                                                </Link>
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ contact.email }}
                                            </div>
                                        </td>
                                        <td class="whitespace-nowrap text-center text-sm font-medium justify-between">
                                            {{ contact.title }}
                                        </td>
                                        <td class="whitespace-nowrap text-center text-sm font-medium justify-between">
                                            <span :class="contact.is_read === 'مقروء'
                                                    ? 'inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800'
                                                    : 'inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800'">
                                                        {{ contact.is_read }}
                                                    </span>
                                        </td>
                                        <td class="whitespace-nowrap text-center text-sm font-medium justify-between">
                                            {{ contact.created_at }}
                                        </td>
                                        <td class="whitespace-nowrap text-center text-sm font-medium justify-between">
                                            <delete-contact-form :contactName="contact.name" :contactId="contact.id" />
                                        </td>
                                    </tr>
                                    <tr v-else>
                                        <td colspan="4" class="px-6 py-3 text-center">لاتوجد رسائل</td>
                                    </tr>
                                    </tbody>
                                </table>
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
import JetInput from '@/Jetstream/Input.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetInputError from '@/Jetstream/InputError.vue'
import JetButton from "@/Jetstream/Button";
import DeleteContactForm from "@/Pages/Contacts/Partials/DeleteContactForm.vue"

export default defineComponent({
    components: {
        AppLayout,
        JetButton,
        JetInput,
        JetLabel,
        JetInputError,
        DeleteContactForm,
        Head,
    },
    props: {
        contacts: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                name: '',
                title: '',
                body: ''
            })
        }
    },
    methods: {
        saveContact() {
            this.form.post(this.route('contacts.store'), {
                onSuccess: () => {
                    this.form.reset()
                    Toast.fire({
                        icon: 'success',
                        title: 'تم انشاء المبنى بنجاح'
                    })
                },
                onError: () => this.$refs.name.focus(),
            })
        }
    }
})
</script>

<style scoped>
* {
    font-size: 14px;
}
table, thead, tbody, th, td, tr {
    padding: 5px 0 5px 0;
    margin: 0;
}
.text-sm {
    padding: 3px 1px 3px 2px;
    margin: 2px;
    font-size: 12px;
}
</style>
