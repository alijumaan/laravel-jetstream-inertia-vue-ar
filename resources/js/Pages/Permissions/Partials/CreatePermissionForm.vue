<template>
    <div>
        <div class="text-center flex justify-between">
            <span class="text-blueGray-700 text-xl font-bold">
                <jet-button @click="confirmShow">
                انشاء صلاحية
                </jet-button>
            </span>
            <Link :href="route('dashboard')">
                <jet-button class="mb-4">الرئيسية</jet-button>
            </Link>
        </div>

        <jet-dialog-modal :show="showModal" :max-width="'lg'" @close="closeModal">
            <template #title>
                انشاء جديد
            </template>

            <template #content>
                <small>انشاء صلاحية جديدة</small>

                <div class="mt-3">
                    <jet-input type="text" class="mt-1 block w-full" placeholder="الاسم"
                               ref="name"
                               v-model="form.name"
                               @keyup.enter="savePermission" />
                    <jet-input-error :message="form.errors.name" class="mt-2" />
                </div>
            </template>

            <template #footer>
                <jet-secondary-button @click="closeModal">
                    الغاء
                </jet-secondary-button>

                <jet-button class="mr-2" @click="savePermission" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    حفظ
                </jet-button>
            </template>
        </jet-dialog-modal>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
import JetDialogModal from '@/Jetstream/DialogModal.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetInputError from '@/Jetstream/InputError.vue'
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'
import JetButton from "@/Jetstream/Button";

export default defineComponent({
    components: {
        JetDialogModal,
        JetInput,
        JetButton,
        JetInputError,
        JetSecondaryButton
    },
    data() {
        return {
            showModal: false,
            form: this.$inertia.form({
                name: '',
            })
        }
    },
    methods: {
        confirmShow() {
            this.showModal = true
            setTimeout(() => this.$refs.name.focus(), 250)
        },

        savePermission() {
            this.form.post(this.route('permissions.store'), {
                preserveScroll: true,
                onSuccess: () => {
                    this.closeModal()
                    Toast.fire({
                        icon: 'success',
                        title: 'تم انشاء الصلاحية بنجاح'
                    })
                },
                onError: () => this.$refs.name.focus(),
                onFinish: () => this.form.reset(),
            })
        },

        closeModal() {
            this.showModal = false
            this.form.reset()
        },
    }
})
</script>
<style scoped></style>
