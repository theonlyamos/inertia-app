<template>
  <Head title="Create User"/>
  <h1 class="text-3xl">Create User</h1>

  <form @submit.prevent="submit" class="mt-5 w-sm-500 p-2">
    <div class="form-group">
      <label for="name" class="block text-xs font-bold upppercase text-gray-700">Name</label>
      <input type="text" v-model="form.name" name="name" id="name" class="mt-1
px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm
sm:text-sm border border-gray-500 rounded-md" required/>
     <span v-if="errors.name" class="block text-sm text-red-500
mt-1">{{errors.name}}</span>
    </div>
    <div class="form-group mt-3">
      <label for="email" class="block text-xs font-bold uppercase text-gray-700">Email</label>
      <input type="email" v-model="form.email" name="email" id="email" class="mt-1
px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm
sm:text-sm border border-gray-500 rounded-md" required/>
      <span v-if="errors.email" class="block text-sm text-red-500 mt-1">{{errors.email}}</span>
    </div>
    <div class="form-group mt-3">
      <label for="password" class="block text-xs font-bold uppercase text-gray-700">Password</label>
      <input type="password" v-model="form.password" name="password" id="password" class="mt-1
px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm
sm:text-sm border border-gray-500 rounded-md" required/>
       <span v-if="errors.password" class="block text-sm text-red-500
mt-1">{{errors.password}}</span>
    </div>
   	<div class="py-3 bg-gray-50 text-right">
   		<button type="submit" class="inline-flex justify-center py-2 px-4 border
border-transparent shadow-sm text-sm font-bold uppercase rounded-md text-white
bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2
focus:ring-offset-2 focus:ring-indigo-500"  :disabled="processing"
:class="{'bg-gray-500': processing}">Submit</button>
  	</div> 
  </form>
</template>

<script setup>
import { Inertia } from '@inertiajs/inertia'
import { reactive, ref } from 'vue'

defineProps({
    errors: Object
})

let form = reactive({
    name: '',
    email: '',
    password: ''
})

let processing = ref(false)

let submit = ()=>{
    Inertia.post('/users', form,{
        onStart: ()=>{processing.value = true},
        onFinish: ()=>{processing.value = false}
    })
}
</script>

