<template>
    <div>
        <div class="text-center flex justify-between">
            <span class="text-blueGray-700 text-xl font-bold">
                <jet-button @click="confirmShow">
                انشاء جديد
                </jet-button>
            </span>
            <Link :href="route('preventatives.index')">
                <jet-button class="mb-4">عودة</jet-button>
            </Link>
        </div>

        <jet-dialog-modal :show="showModal" :max-width="'lg'" @close="closeModal">
            <template #title>
                انشاء مبنى جديد
            </template>

            <template #content>
                <small>يرجى التأكد من صحة البيانات المدخلة قبل الحفظ</small>

                <div class="mt-3">
                    <jet-input type="text" class="mt-1 block w-full" placeholder="الاسم"
                               ref="name"
                               v-model="form.name" />
                    <jet-input-error :message="form.errors.name" class="mt-2" />
                </div>

                <div class="mt-3">
                    <jet-input type="text" class="mt-1 block w-full" placeholder="رقم المبنى"
                               ref="number"
                               v-model="form.number" />
                    <jet-input-error :message="form.errors.number" class="mt-2" />
                </div>

                <div v-if="$page.props.is_admin" class="mt-3">
                    <div class="relative">
                        <jet-label value="المفتش" />
                        <select v-model="form.user_id" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full">
                            <option value="">المفتش</option>
                            <option v-for="user in users" :value="user.id">{{ user.name }}</option>
                        </select>
                    </div>
                    <jet-input-error :message="form.errors.user_id" class="mt-2" />
                </div>

                <div class="mt-3">
                    <div class="relative">
                        <jet-label value="الفترة" />
                        <select v-model="form.period_id" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full">
                            <option value="">الفترة</option>
                            <option v-for="period in periods" :value="period.id">{{ period.time_name_arabic }}</option>
                        </select>
                    </div>
                    <jet-input-error :message="form.errors.period_id" class="mt-2" />
                </div>

                <div class="mt-3">
                    <jet-input type="text" class="mt-1 block w-full" placeholder="ملاحظات"
                               ref="notes"
                               v-model="form.notes" />
                    <jet-input-error :message="form.errors.notes" class="mt-2" />
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
            buildings: Object,
            users: Object,
            periods: Object
        },
        data() {
            return {
                showModal: false,
                form: this.$inertia.form({
                    name: '',
                    number: '',
                    user_id: '',
                    period_id: '',
                    notes: '',
                })
            }
        },
        methods: {
            confirmShow() {
                this.showModal = true
                setTimeout(() => this.$refs.name.focus(), 250)
            },

            saveBuilding() {
                this.form.post(this.route('buildings.store'), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.closeModal()
                        Toast.fire({
                            icon: 'success',
                            title: 'تم انشاء المبنى بنجاح'
                        })
                    },
                    onError: () => this.$refs.name.focus(),
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
