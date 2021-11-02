<template>
    <div>
        <button @click="confirmShow" class="text-red-700 hover:text-indigo-900">
            <i class="fa fa-trash "></i>
        </button>
        <jet-dialog-modal :show="showModal" :max-width="'sm'" @close="closeModal">
            <template #title>
                هل تريد بالتأكيد حذف ({{ permissionName }})؟
            </template>

            <template #content>
                <span class="text-red-700">لن تستطيع استعادة الصلاحية بعد حذفها</span>
            </template>

            <template #footer>
                <jet-secondary-button @click="closeModal">
                    الغاء
                </jet-secondary-button>

                <jet-danger-button class="mr-2" @click="deletePermission(permissionId)">
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
            permissionName: String,
            permissionId: Number
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

            deletePermission(roleId) {
                this.$inertia.delete(route('permissions.destroy', roleId), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.closeModal()
                        Toast.fire({
                            icon: 'success',
                            title: 'تم حذف الصلاحية بنجاح'
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
