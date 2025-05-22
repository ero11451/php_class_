<div class="max-w-6xl mx-auto p-6 m-10 bg-white rounded-xl shadow-md grid grid-cols-1 md:grid-cols-2 gap-10">
  <!-- Product Image -->
  <div>
    <img src="<?= $data['image'] ?>" alt="Product Image"
         class="w-full h-auto rounded-lg shadow-sm object-cover">
  </div>

  <!-- Product Details -->
  <div class="flex flex-col justify-between">
    <div>
      <h1 class="text-3xl font-bold text-gray-900 mb-2"><?= $data['name'] ?></h1>
      <p class="text-gray-600 mb-4"><?=$data['description'] ?>.</p>

      <div class="text-2xl font-semibold  mb-6">£<?=$data['price'] ?></div>

      <p></p>

      <!-- Quantity Selector -->
      <div class="flex items-center space-x-3 mb-6">
        <label for="quantity" class="text-sm font-medium text-gray-700">Quantity:</label>
        <input type="number" id="quantity" name="quantity" min="1" value="1"
               class="w-20 px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
      </div>

      <!-- Add to Cart Button -->
      <button class="w-full bg-black hover:bg-black-700 text-white font-semibold py-3 px-6 rounded-md transition">
        Add to Cart
      </button>
    </div>
  </div>
</div>
