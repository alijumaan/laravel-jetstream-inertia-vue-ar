<template>
    <div>
        <jet-danger-button @click="confirmShow" class="btn-sm">
            تحديث
        </jet-danger-button>

        <jet-dialog-modal :show="showModal" :max-width="'sm'" @close="closeModal">
            <template #title>
                هل أنت متأكد من تحديث مبنى ({{ building.name }})؟
            </template>

            <template #content>
                <span class="text-red-700">لن تستطيع التراجع بعد التحديث</span>
            </template>

            <template #footer>
                <jet-secondary-button @click="closeModal">
                    الغاء
                </jet-secondary-button>

                <jet-danger-button class="mr-2" @click="updateStatus(building.slug)">
                    تحديث
                </jet-danger-button>
            </template>
        </jet-dialog-modal>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
import JetDialogModal from '@/Jetstream/DialogModal.vue'
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'
import JetButton from "@/Jetstream/Button";
import JetDangerButton from "@/Jetstream/DangerButton";

export default defineComponent({
    components: {
        JetDialogModal,
        JetButton,
        JetDangerButton,
        JetSecondaryButton
    },
    props: {
        building: Object,
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

        updateStatus(slug) {
            this.$inertia.put(route('buildings.update_status', slug), null, {
                preserveScroll: true,
                onSuccess: () => {
                    this.closeModal()
                    Toast.fire({
                        icon: 'success',
                        title: 'تم تحديث المبنى بنجاح'
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
<style scoped>
.btn-sm {
    padding: 6px 2px 5px 3px;
    margin: 2px;
    font-size: 9px;
}
</style>
