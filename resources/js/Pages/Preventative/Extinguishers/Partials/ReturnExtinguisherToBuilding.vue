<template>
    <div>
        <button @click="confirmShow" class="text-red-700 hover:text-indigo-900">
            <i class="fas fa-undo text-red-700 mr-2"></i>
        </button>
        <jet-dialog-modal :show="showModal" :max-width="'sm'" @close="closeModal">
            <template #title>
                هل انت متاكد ارجاع الطفاية لمبنى ({{ buildingName }})؟
            </template>

            <template #content>
                <span class="text-red-700">لن تستطيع التراجع بعد التنفيذ</span>
            </template>

            <template #footer>
                <jet-secondary-button @click="closeModal">
                    الغاء
                </jet-secondary-button>

                <jet-danger-button class="mr-2" @click="returnExtinguisherToBuilding(extinguisherId, buildingId)">
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
            buildingId: Number,
            extinguisherId: Number,
            buildingName: String
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
            returnExtinguisherToBuilding(extinguisherId, buildingId) {
                this.$inertia.delete(route('extinguishers.return', [extinguisherId, buildingId]), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.closeModal()
                        Toast.fire({
                            icon: 'success',
                            title: 'تم ارجاع الطفاية الى المبنى بنجاح'
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
