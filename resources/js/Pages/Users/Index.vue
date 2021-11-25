<template>
  <Head title="Users"/>

  <div class="flex justify-between mb-6">
    <div class="flex">
      <h1 class="text-3xl">Users</h1>
      <Link href="/users/create" class="inline-block text-center bg-indigo-600
border border-transparent rounded-md py-1 px-3 ml-2 font-large text-white hover:bg-indigo-700">+</Link>
    </div>
    <input type="text" v-model="search" class="border px-2 rounded-lg" placeholder="Search..."/>
  </div>

 <div class="flex flex-col">
  <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
      <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
          <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="user in users.data" :key="user.id">
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div>
                    <div class="text-sm font-medium text-gray-900">
                      {{user.name}}
                    </div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <Link :href="`/users/${user.id}/edit`" class="text-indigo-600 hover:text-indigo-900">Edit</Link>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
	<div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
  <div class="flex-1 flex justify-between sm:hidden">
    <Link :href="users.prev_page_url" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
      Previous
    </Link>
    <Link :href="users.next_page_url" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
      Next
    </Link>
  </div>
  <div class="hidden sm:flex-1 sm:flex flex-column sm:items-center sm:justify-between">
    <div class="flex">
      <p class="text-sm text-gray-700">
        Showing
        <span class="font-medium">{{users.from}}</span>
        to
        <span class="font-medium">{{users.to}}</span>
        of
        <span class="font-medium">{{users.total}}</span>
        results
      </p>
    </div>
    <div>
      <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
				<Link :href="users.prev_page_url" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
          <span class="sr-only">Previous</span>
          <!-- Heroicon name: solid/chevron-left -->
          <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
          </svg>
        </Link>
				<template v-for="(link, index) in users.links">
					<template v-if="index > 0">
        		<Link v-if="index <= users.per_page" :href="link.url" v-html="link.label" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium" :class="{'z-10 bg-indigo-50 border-indigo-500 text-indigo-600': link.active}">
        		</Link>
					</template>
				</template>
				<Link :href="users.next_page_url" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
          <span class="sr-only">Next</span>
          <!-- Heroicon name: solid/chevron-left -->
					<svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
          </svg>
        </Link>

      </nav>
    </div>
  </div>
</div>
 
</template>

<script setup>
import { Inertia } from '@inertiajs/inertia'
import { ref, watch } from 'vue'

let props = defineProps({
  users: Object,
  filters: Object
})

let search = ref(props.filters.search)

watch(search, value => {
  Inertia.get('/users', {search: value}, {
    preserveState: true,
    replace: true
  })
})
</script>
