<template>
    <div>
        <a href="#" @click="confirmShow" class="text-indigo-600 hover:text-indigo-900">
            <i class="fa fa-edit"></i>
        </a>

        <jet-dialog-modal :show="showModal" :max-width="'lg'" @close="closeModal">
            <template #title>
                تعديل {{ form.name }}
            </template>

            <template #content>
                <div class="mt-4">
                    <jet-input type="text" class="mt-1 block w-full" placeholder="الاسم"
                               ref="name"
                               v-model="form.name"
                               @keyup.enter="updatePermission" />

                    <jet-input-error :message="form.errors.name" class="mt-2" />
                </div>
            </template>

            <template #footer>
                <jet-secondary-button @click="closeModal">
                    الغاء
                </jet-secondary-button>

                <jet-button class="mr-2" @click="updatePermission" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    تعديل
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
    props: {
        permission: Object,
    },
    data() {
        return {
            showModal: false,

            form: this.$inertia.form({
                name: this.permission.name,
            })
        }
    },
    methods: {
        confirmShow() {
            this.showModal = true
            setTimeout(() => this.$refs.name.focus(), 250)
        },

        updatePermission() {
            this.form.put(this.route('permissions.update', this.permission.id), {
                preserveScroll: true,
                onSuccess: () => {
                    this.closeModal()
                    Toast.fire({
                        icon: 'success',
                        title: 'تم تعديل الصلاحية بنجاح'
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
