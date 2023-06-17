<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head,Link,useForm } from '@inertiajs/vue3';

import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
const props =defineProps({
    company:{
        type:Object,
        reqired:true
    }
})
const  form =useForm({
    name:props.company.data.name,
    email:props.company.data.email,
    website:props.company.data.website,
    logo:props.company.data.logo
})
</script>

<template>
    <Head title="Update Company" />

    <AdminLayout>
       
        <div class="max-w-7xl mx-auto py-4">
          <div class="flex justify-between">
            <h1>update company </h1>
             <Link :href="route('companies.index')" class="px-3 py-2 text-white font-semibold bg-indigo-500 hover:bg-indigo-700 rounded">Back</Link>
          </div>
             <div class="mt-6 max-w-md mx-auto bg-slate-100 shadow-lg rounded-lg p-6">
                <form @submit.prevent="form.put(route('companies.update',company.data.id))">
            <div>
                <InputLabel for="name" value="name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>
            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="email"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>
            <div>
                <InputLabel for="website" value="website" />

                <TextInput
                    id="website"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.website"
                    required
                    autofocus
                    autocomplete="userwebsite"
                />

                <InputError class="mt-2" :message="form.errors.website" />
            </div>

            <div>
                <InputLabel for="logo" value="logo" />

              
                <input type="file" @input="form.logo = $event.target.files[0]" />

                <InputError class="mt-2" :message="form.errors.logo" />
            </div>


          

            <div class="flex items-center mt-4">
               
                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Update
                </PrimaryButton>
            </div>
        </form>
            </div>
        </div>
    </AdminLayout>
</template>
