<div class="max-w-2xl mx-auto mt-10 p-6 bg-white">
  <h1 class="text-2xl font-bold mb-6 text-gray-800">Login</h1>

  <form method="post" action="" class="space-y-4 mb-8">
    <input type="text" name="email" placeholder="Email..." required
      class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">

    <input type="password" name="password" placeholder="Password..." required
      class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">

    <button type="submit"
      class="w-full bg-black text-white font-semibold py-3 rounded-md hover:bg-black transition">
      Submit
    </button>
  </form>
  <div class="text-">
    <a href="/register" class="text-black hover:underline">Don't have an account? Register here</a>
  </div>

  <div class="space-y-2">
    <?php
    foreach ($data as $value) {
      foreach ($value as $v) {
        echo "<div class='p-3 bg-gray-100 rounded-md border border-gray-300 text-gray-800'>";
        echo htmlspecialchars($v); // Avoid XSS
        echo "</div>";
      }
    }
    ?>
  </div>
</div>