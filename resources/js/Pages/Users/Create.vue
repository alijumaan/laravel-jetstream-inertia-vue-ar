<template>
    <app-layout title="Users">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                انشاء مستخدم
            </h2>
        </template>
        <jet-authentication-card>
            <div class="rounded-t mb-0 px-3 py-6">
                <div class="text-center flex justify-between">
                    <h6 class="text-blueGray-700 text-xl font-bold">
                    </h6>
                    <Link :href="route('users.index')">
                        <jet-button >الغاء</jet-button>
                    </Link>
                </div>
            </div>
            <form @submit.prevent="submit">
                <div>
                    <jet-label for="name" value="الاسم" />
                    <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" autofocus autocomplete="name" />
                    <jet-input-error :message="form.errors.name" class="mt-2" />
                </div>

                <div class="mt-4">
                    <jet-label for="username" value="اسم المستخدم" />
                    <jet-input id="username" type="text" class="mt-1 block w-full" v-model="form.username" autofocus autocomplete="username" />
                    <jet-input-error :message="form.errors.username" class="mt-2" />
                </div>

                <div class="mt-4">
                    <jet-label for="email" value="الإيميل" />
                    <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" />
                    <jet-input-error :message="form.errors.email" class="mt-2" />
                </div>

                <div class="mt-4">
                    <jet-label for="role" value="الوظيفة" />
                    <select v-model="form.role" id="role" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full">
                        <option v-for="role in roles" :value="role.name">{{ role.name }}</option>
                    </select>
                    <jet-input-error :message="form.errors.role" class="mt-2" />
                </div>

                <div class="mt-4">
                    <jet-label for="password" value="كلمة المرور" />
                    <jet-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" autocomplete="new-password" />
                    <jet-input-error :message="form.errors.password" class="mt-2" />
                </div>

                <div class="mt-4">
                    <jet-label for="password_confirmation" value="تأكيد كلمة المرور" />
                    <jet-input id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" autocomplete="new-password" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <jet-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        تسجيل
                    </jet-button>
                </div>
        </form>
        </jet-authentication-card>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue'
    import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue'
    import { Head } from '@inertiajs/inertia-vue3';
    import AppLayout from "@/Layouts/AppLayout";
    import JetLabel from "@/Jetstream/Label";
    import JetInput from "@/Jetstream/Input";
    import JetButton from "@/Jetstream/Button";
    import JetInputError from '@/Jetstream/InputError.vue'

    export default defineComponent({
        components: {
            JetAuthenticationCard,
            JetAuthenticationCardLogo,
            AppLayout,
            JetLabel,
            JetInput,
            JetButton,
            JetInputError,
            Head,
        },
        props: {
            roles: Object,
        },
        data() {
            return {
                form: this.$inertia.form({
                    name: '',
                    username: '',
                    email: '',
                    role: '',
                    password: '',
                    password_confirmation: ''
                })
            }
        },
        methods: {
            submit() {
                this.form.post(this.route('users.store'), {
                    onFinish: () => this.form.reset('password', 'password_confirmation'),
                })
            }
        }
    })
</script>

<style scoped></style>
