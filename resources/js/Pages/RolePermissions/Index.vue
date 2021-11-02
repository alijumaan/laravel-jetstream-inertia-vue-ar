<template>
    <app-layout title="الصلاحيات">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                تعيين الصلاحيات
            </h2>
        </template>
        <section class="relative w-full max-w-md px-5 py-4 mx-auto rounded-md">
            <select v-model="roleId" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full">
                <option value="">الدور</option>
                <option v-for="role in roles.data" :value="role.id">
                    {{ role.name }}
                </option>
            </select>
            <div v-if="rolePermissions" class="mt-3">
                <div v-for="role in rolePermissions">
                    <ul v-for="(permission, index) in role.permissions">
                        <li>
                            {{ index + 1 }} - <span class="text-green-800">{{ permission.name}}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
    </app-layout>
</template>

<script>
import { defineComponent } from 'vue'
import AppLayout from "@/Layouts/AppLayout";
import JetButton from "@/Jetstream/Button";

export default defineComponent({
    components: {
        AppLayout,
        JetButton,
    },
    props: {
        roles: Object,
    },
    data() {
        return {
            rolePermissions: [],
            roleId: ""
        }
    },
    watch: {
        roleId: {
            handler() {
                this.getPermissions();
            }
        }
    },
    methods: {
        getPermissions() {
            if (this.roleId === '') {
                this.rolePermissions = [];
                return false;
            }
            axios.get('role_permissions/' + this.roleId).then(response => {
                this.rolePermissions = response.data.rolePermissions
            });
        }
    }

})
</script>

<style scoped></style>
