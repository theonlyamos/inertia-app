<template>
  <header class="flex justify-between p-6 bg-gray-200">
    <div class="flex items-center">
      <h1 class="font-bold text-lg">Inertia App</h1>
      <h2 class="ml-2">Welcome back, {{$page.props.auth.user.username}}</h2>
    </div>
    <Nav />
  </header>
  <main class="max-w-3xl mx-auto mt-10">
    <section>
      <slot />
    </section>
  </main>
</template>

<script>
import Nav from './Nav';
export default {
  components: { Nav },
};
</script>
