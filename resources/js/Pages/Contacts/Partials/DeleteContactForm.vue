<template>
    <div>
        <button @click="confirmShow" class="text-red-700 hover:text-indigo-900">
            <i class="fa fa-trash "></i>
        </button>
        <jet-dialog-modal :show="showModal" :max-width="'sm'" @close="closeModal">
            <template #title>
                هل تريد بالتأكيد حذف رسالة ({{ contactName }})؟
            </template>

            <template #content>
                <span class="text-red-700">لن تستطيع استعادة الرسالة بعد حذفها</span>
            </template>

            <template #footer>
                <jet-secondary-button @click="closeModal">
                    الغاء
                </jet-secondary-button>

                <jet-danger-button class="mr-2" @click="deleteContact(contactId)">
                    حذف
                </jet-danger-button>
            </template>
        </jet-dialog-modal>
    </div>
</template>

<script>
    import { defineComponent } from 'vue'
    import JetDialogModal from '@/Jetstream/DialogModal.vue'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'
    import JetDangerButton from '@/Jetstream/DangerButton.vue'

    export default defineComponent({
        components: {
            JetDialogModal,
            JetDangerButton,
            JetSecondaryButton
        },
        props: {
            contactName: String,
            contactId: Number
        },
        data() {
            return {
                showModal: false,
            }
        },
        methods: {
            confirmShow() {
                this.showModal = true
            },

            deleteContact(contactId) {
                this.$inertia.delete(route('contacts.destroy', contactId), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.closeModal()
                        Toast.fire({
                            icon: 'success',
                            title: 'تم حذف الرسالة بنجاح'
                        })
                    }
                })
            },

            closeModal() {
                this.showModal = false
            },
        }
    })
</script>
<style scoped></style>
