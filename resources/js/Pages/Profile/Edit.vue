<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue'
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue'
import DeleteUserForm from './Partials/DeleteUserForm.vue'
import DetailProfile from './Partials/DetailProfile.vue'

defineProps({
    mustVerifyEmail: Boolean,
    status: String,
    user: {},
})
</script>

<template>
    <AuthenticatedLayout title="Profile">
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Editar perfil
            </h2>
        </template>

        <div class="space-y-6">
            <div
                class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg"
            >

                <DetailProfile
                :account="user"></DetailProfile>
            </div>

<!--            <div-->
<!--                class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg"-->
<!--            >-->
<!--                <UpdatePasswordForm class="max-w-xl" />-->
<!--            </div>-->

<!--            <div-->
<!--                class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg"-->
<!--            >-->
<!--                <DeleteUserForm class="max-w-xl" />-->
<!--            </div>-->
        </div>
    </AuthenticatedLayout>
</template>
