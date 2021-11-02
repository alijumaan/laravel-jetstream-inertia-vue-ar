<template>
    <div>
        <button @click="confirmShow" class="text-red-700 hover:text-indigo-900">
            <i class="fa fa-trash "></i>
        </button>
        <jet-dialog-modal :show="showModal" :max-width="'sm'" @close="closeModal">
            <template #title>
                هل تريد بالتأكيد حذف ({{ buildingName }})؟
            </template>

            <template #content>
                <span class="text-red-700">لن تستطيع استعادة الدور بعد حذفه</span>
            </template>

            <template #footer>
                <jet-secondary-button @click="closeModal">
                    الغاء
                </jet-secondary-button>

                <jet-danger-button class="mr-2" @click="deleteBuilding(buildingSlug)">
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
            buildingName: String,
            buildingSlug: String
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

            deleteBuilding(building) {
                this.$inertia.delete(route('buildings.destroy', building), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.closeModal()
                        Toast.fire({
                            icon: 'success',
                            title: 'تم حذف المبنى بنجاح'
                        })
                    },
                })
            },

            closeModal() {
                this.showModal = false
            },
        }
    })
</script>
<style scoped></style>
