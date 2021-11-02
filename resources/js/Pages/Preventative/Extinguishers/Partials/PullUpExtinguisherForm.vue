<template>
    <div>
        <div class="text-center flex justify-between">
            <span class="text-blueGray-700 text-xl font-bold">
                <jet-button @click="confirmShow">
                سحب طفاية
                </jet-button>
            </span>
            <Link :href="route('preventatives.index')">
                <jet-button class="mb-4">عودة</jet-button>
            </Link>
        </div>

        <jet-dialog-modal :show="showModal" :max-width="'lg'" @close="closeModal">
            <template #title>
                سحب طفاية حريق من مبنى
            </template>

            <template #content>
                <small>يرجى التأكد من صحة البيانات المدخلة قبل الحفظ</small>

                <div class="mt-3">
                    <div class="relative">
                        <jet-label value="الطفاية" />
                        <select v-model="form.extinguisher_id" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full">
                            <option value="">الطفاية</option>
                            <option v-for="extinguisher in extinguishers.data" :value="extinguisher.id">{{ extinguisher.type }}</option>
                        </select>
                    </div>
                    <jet-input-error :message="form.errors.extinguisher_id" class="mt-2" />
                </div>
                <div class="mt-3">
                    <div class="relative">
                        <jet-label value="المبنى" />
                        <select v-model="form.building_id" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full">
                            <option value="">المبنى</option>
                            <option v-for="building in buildings" :value="building.id">{{ building.name }}</option>
                        </select>
                    </div>
                    <jet-input-error :message="form.errors.building_id" class="mt-2" />
                </div>

            </template>

            <template #footer>
                <jet-secondary-button @click="closeModal">
                    الغاء
                </jet-secondary-button>

                <jet-button class="mr-2" @click="saveBuilding" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
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
    import JetLabel from '@/Jetstream/Label.vue'
    import JetInputError from '@/Jetstream/InputError.vue'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'
    import JetButton from "@/Jetstream/Button";
    import Swal from "sweetalert2";

    export default defineComponent({
        components: {
            JetDialogModal,
            JetInput,
            JetLabel,
            JetButton,
            JetInputError,
            JetSecondaryButton
        },
        props: {
            extinguishers: Object,
            buildings: Object
        },
        data() {
            return {
                showModal: false,
                form: this.$inertia.form({
                    extinguisher_id: '',
                    building_id: '',
                })
            }
        },
        methods: {
            confirmShow() {
                this.showModal = true
            },

            saveBuilding() {
                this.form.post(this.route('extinguishers.store'), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.closeModal()
                        Toast.fire({
                            icon: 'success',
                            title: 'تم سحب الطفاية من المبنى بنجاح'
                        })
                    },
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
