<template>
    <div>
        <div class="text-center flex justify-between">
            <span class="text-blueGray-700 text-xl font-bold">
                <jet-button @click="confirmShow">
                انشاء وظيفة
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
                <small>انشاء وظيفة جديدة وتعيين صلاحيات عليها</small>

                <div class="mt-3">
                    <jet-input type="text" class="mt-1 block w-full" placeholder="الاسم"
                               ref="name"
                               v-model="form.name"
                               @keyup.enter="saveRole" />
                    <jet-input-error :message="form.errors.name" class="mt-2" />
                </div>
                <div class="mt-4">
                    <VueMultiselect
                        v-model="form.permissions"
                        :options="permissions"
                        :multiple="true"
                        :taggable="true"
                        :close-on-select="false"
                        placeholder="اختر الصلاحيات"
                        label="name"
                        track-by="name"
                        :clear-on-select="false"
                        :preserve-search="false"
                        :preselect-first="false"
                    />
                    <jet-input-error :message="form.errors.permissions" class="mt-2" />
                </div>
            </template>

            <template #footer>
                <jet-secondary-button @click="closeModal">
                    الغاء
                </jet-secondary-button>

                <jet-button class="mr-2" @click="saveRole" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
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
    import VueMultiselect from 'vue-multiselect';

    export default defineComponent({
        components: {
            VueMultiselect,
            JetDialogModal,
            JetInput,
            JetButton,
            JetInputError,
            JetSecondaryButton
        },
        props: {
            permissions: Object
        },
        data() {
            return {
                showModal: false,
                form: this.$inertia.form({
                    name: '',
                    permissions: [],
                })
            }
        },
        methods: {
            confirmShow() {
                this.showModal = true
                setTimeout(() => this.$refs.name.focus(), 250)
            },

            saveRole() {
                this.form.post(this.route('roles.store'), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.closeModal()
                        Toast.fire({
                            icon: 'success',
                            title: 'تم انشاء الدور بنجاح'
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
