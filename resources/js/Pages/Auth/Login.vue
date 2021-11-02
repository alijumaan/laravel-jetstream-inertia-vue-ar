<template>
    <Head title="دخول" />

    <Header />
    <jet-authentication-card class="px-8">
        <template #logo>
            <jet-authentication-card-logo />
        </template>

        <jet-validation-errors class="mb-4" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <jet-label for="username" value="اسم المستخدم او البريد الإلكتروني" />
                <jet-input id="username" type="text" class="mt-1 block w-full" v-model="form.username" autofocus />
            </div>

            <div class="mt-4">
                <jet-label for="password" value="الرقم السري" />
                <jet-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <jet-checkbox name="remember" v-model:checked="form.remember" />
                    <span class="mr-2 text-sm text-gray-600">تذكرني</span>
                </label>
            </div>


            <div class="flex items-center justify-end mt-4">
                <Link v-if="canResetPassword" :href="route('register')" class="ml-3 text-sm text-blue-800 hover:text-gray-900">
                    تسجيل حساب جديد
                </Link>                <Link v-if="canResetPassword" :href="route('password.request')" class="ml-3 underline text-sm text-gray-600 hover:text-gray-900">
                    نسيت كلمة المرور؟
                </Link>

                <jet-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    دخول
                </jet-button>
            </div>
        </form>
    </jet-authentication-card>
</template>

<script>
    import { defineComponent } from 'vue'
    import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue'
    import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue'
    import JetButton from '@/Jetstream/Button.vue';
    import JetInput from '@/Jetstream/Input.vue'
    import JetCheckbox from '@/Jetstream/Checkbox.vue'
    import JetLabel from '@/Jetstream/Label.vue'
    import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'
    import Header from "../../Layouts/Header";
    import { Head } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Head,
            Header,
            JetAuthenticationCard,
            JetAuthenticationCardLogo,
            JetButton,
            JetInput,
            JetCheckbox,
            JetLabel,
            JetValidationErrors,
        },

        props: {
            canResetPassword: Boolean,
            status: String,
        },

        data() {
            return {
                form: this.$inertia.form({
                    username: '',
                    password: '',
                    remember: false
                })
            }
        },

        methods: {
            submit() {
                this.form
                    .transform(data => ({
                        ... data,
                        remember: this.form.remember ? 'on' : ''
                    }))
                    .post(this.route('login'), {
                        onFinish: () => this.form.reset('password'),
                    })
            }
        }
    })
</script>
