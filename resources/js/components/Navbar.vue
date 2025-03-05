<template>
  <nav class="navbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a href="/" class="nav-link">Home</a>
      </li>
      <li class="nav-item">
        <a href="/clients" class="nav-link">Clients</a>
      </li>
    </ul>
  </nav>
</template>

<script>
export default {
  name: "Navbar",
};
</script>

<style scoped>
.navbar {
  background-color: #f8f9fa;
  padding: 1rem;
}

.navbar-nav {
  list-style: none;
  display: flex;
  gap: 1rem;
  margin: 0;
  padding: 0;
}

.nav-item {
  margin: 0;
}

.nav-link {
  text-decoration: none;
  color: #007bff;
  font-weight: bold;
}

.nav-link:hover {
  text-decoration: underline;
}
</style>
