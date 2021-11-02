<template>
    <!-- header ==============================  -->
    <div class="p-7 flex justify-between items-center">
        <Link :href="route('dashboard')" class="inline-block text-black hover:text-indigo-200">
            <jet-application-mark class="block h-9 w-auto" />
        </Link>
        <!--   right side -->
        <div class="flex items-center">
            <div v-if="$page.props.user" class="inline-block text-black hover:text-gray-700 ml-2">
                <!-- Authentication -->
                <form method="POST" @submit.prevent="logout">
                    <button class="inline-block text-black hover:text-indigo-500 ml-2" type="submit">
                        خروج
                    </button>
                </form>
            </div>

            <template v-else>
                <Link v-if="canLogin" :href="route('login')" class="inline-block text-black hover:text-indigo-500 ml-2">
                    الدخول
                </Link>
                <Link v-if="canRegister" :href="route('register')" class="inline-block text-black hover:text-indigo-500 mr-2">
                    التسجيل
                </Link>
            </template>
        </div>
    </div>
</template>

<script>
    import { defineComponent } from 'vue'
    import JetApplicationMark from '@/Jetstream/ApplicationMark.vue'

    export default defineComponent({
        components: {
            JetApplicationMark,
        },
        props: {
            canLogin: Boolean,
            canRegister: Boolean,
        },
        methods: {
            logout() {
                this.$inertia.post(route('logout'));
            },
        }
    })
</script>

<style scoped></style>
