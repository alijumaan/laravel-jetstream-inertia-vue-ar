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
                               @keyup.enter="updateRole" />

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
                    />

                    <jet-input-error :message="form.errors.permissions" class="mt-2" />
                </div>
            </template>

            <template #footer>
                <jet-secondary-button @click="closeModal">
                    الغاء
                </jet-secondary-button>

                <jet-button class="mr-2" @click="updateRole" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
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
import VueMultiselect from 'vue-multiselect';

export default defineComponent({
    components: {
        JetDialogModal,
        JetInput,
        JetButton,
        JetInputError,
        JetSecondaryButton,
        VueMultiselect
    },
    props: {
        role: Object,
        permissions: Object
    },
    data() {
        return {
            showModal: false,

            form: this.$inertia.form({
                name: this.role.name,
                permissions: this.role.permissions
            })
        }
    },
    methods: {
        confirmShow() {
            this.showModal = true

            setTimeout(() => this.$refs.name.focus(), 250)
        },

        updateRole() {
            this.form.put(this.route('roles.update', this.role.id), {
                preserveScroll: true,
                onSuccess: () => {
                    this.closeModal()
                    Toast.fire({
                        icon: 'success',
                        title: 'تم تعديل الدور بنجاح'
                    })
                    this.$inertia.get('/roles')
                },
                onError: () => this.$refs.name.focus(),
            })
        },

        closeModal() {
            this.form.reset()
            this.showModal = false
        },
    }
})
</script>
<style scoped></style>
