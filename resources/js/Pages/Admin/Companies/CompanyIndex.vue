<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head,Link,useForm } from '@inertiajs/vue3';
defineProps(['companies'])
import TableRow from '@/Components/TableRow.vue';
import Table from '@/Components/Table.vue';
import TableHead  from '@/Components/TableHead.vue';
import TableDataCell from '@/Components/TableDataCell.vue';
import { ref } from "vue";
import Modal from "@/Components/Modal.vue";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Pagination from "@/Components/Pagination.vue";
const form = useForm({})
const showConfirmDeleteUserModal = ref(false)

const confirmDeleteUser = () => {
      showConfirmDeleteUserModal.value = true;
}

const closeModal = () => {
  showConfirmDeleteUserModal.value = false;
}

const deleteUser = (id) => {
   form.delete(route('companies.destroy', id), {
    onSuccess: () => closeModal()
   });
}
</script>

<template>
    <Head title="Dashboard" />

    <AdminLayout>
       
        <div class="max-w-7xl mx-auto py-4">
          <div class="flex justify-between">
            <h1>companies admin</h1>
            <Link :href="route('companies.create')" class="px-3 py-2 text-white font-semibold bg-indigo-500 hover:bg-indigo-700 rounded">NEW COMPANY</Link>
          </div>
             <div class="mt-6">
                <Table>
                    <template #header>
                     <TableRow>
                        <TableHead>  
                            ID                   
                        </TableHead>
                        <TableHead>  
                           image
                        </TableHead>
                        <TableHead> 
                            Name                    
                        </TableHead>  
                        <TableHead> 
                            website                    
                        </TableHead>
                        <TableHead> 
                            Actions                    
                        </TableHead>
                     </TableRow>
                    </template>
                    <template #default>
                        <table-row v-for="company in companies.data " :key="company.id" class="border-b">
                            <TableDataCell>{{ company.id }}</TableDataCell>
                            <TableDataCell>
                          
<img class="h-auto max-w-full" style="width: 100px;height: 100px;" :src="`storage/${company.logo}`" alt="image description">

                            
                        </TableDataCell>
                            <TableDataCell>{{ company.name }} </TableDataCell>
                            <TableDataCell>{{ company.website }}</TableDataCell>
                            <TableDataCell class="space-x-1">
                                <Link :href="route('companies.edit',company.id)" class="text-green-400 hover:text-green-600"> Edit </Link> /
                                <button @click="confirmDeleteUser" class="text-red-400 hover:text-red-600">Delete</button>
               <Modal :show="showConfirmDeleteUserModal" @close="closeModal">
                 <div class="p-6">
                  <h2 class="text-lg font-semibold text-slate-800">Are you sure to delete this user?</h2>
                  <div class="mt-6 flex space-x-4">
                    <DangerButton @click="deleteUser(company.id)">Delete</DangerButton>
                    <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
                  </div>
                 </div>
               </Modal>


                            </TableDataCell>

                        </table-row>
                    </template>
                </Table>
               
                <Pagination :links="companies.meta.links" />
            </div>
        </div>
    </AdminLayout>
</template>
