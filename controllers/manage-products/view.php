<!-- Alpine.js for tab interaction -->
<script src="https://unpkg.com/alpinejs" defer></script>

<div x-data="{ tab: 'list' }" class="max-w-5xl mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
  <h2 class="text-2xl font-semibold mb-4">Manage Products</h2>

  <!-- Tab headers -->
  <div class="flex space-x-4 border-b pb-2 mb-6">
    <button
      @click="tab = 'list'"
      :class="tab === 'list' ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500'"
      class="px-4 py-2 font-semibold focus:outline-none">
      Product List
    </button>
    <button
      @click="tab = 'add'"
      :class="tab === 'add' ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500'"
      class="px-4 py-2 font-semibold focus:outline-none">
      Add Product
    </button>
  </div>

  <!-- Tab Content: Product List -->
  <div x-show="tab === 'list'" class="space-y-4">
    <table class="min-w-full text-sm border">
      <thead class="bg-gray-100 text-left">
        <tr>
          <th class="px-6 py-3">Name</th>
          <th class="px-6 py-3">Description</th>
          <th class="px-6 py-3">Price</th>
          <th class="px-6 py-3">Stock</th>
          <th class="px-6 py-3">Image</th>
          <th class="px-6 py-3">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($products)): ?>

          <?php foreach ($products as $product): ?>
            <tr class="border-t">
              <td class="px-6 py-4"><?= htmlspecialchars($product['name'] ?? '') ?></td>
              <td class="px-6 py-4"><?= htmlspecialchars($product['description'] ?? '') ?></td>
              <td class="px-6 py-4">£<?= htmlspecialchars($product['price'] ?? '') ?></td>
              <td class="px-6 py-4"><?= (int)$product['stock'] ?></td>
              <td class="px-6 py-4">
              <!-- /Users/user/Desktop/php_class/controllers/manage-products/uploads/product_6819ce3b0893a0.45574325.jpeg -->
                <?php if (!empty($product['image'])): ?>
                  <img src="<?= $product['image']?>" alt="<?= $product['image'] ?>" class="w-16 h-16 rounded object-cover">
                <?php else: ?>
                  <span class="text-gray-400 italic">No image</span>
                <?php endif; ?>

              </td>
              <td class="px-6 py-4 flex space-x-2">
                <button class="text-blue-600 hover:text-blue-800"><i data-lucide="edit" class="w-5 h-5"></i></button>
                <form method="POST" class="inline">
                  <input type="hidden" name="id" value="<?= htmlspecialchars($product['id']) ?>">
                  <input name="method" type="hidden" value="delete">
                  <button type="submit" class="text-green-600 hover:text-green-800">
                    delete
                  </button>
                </form>
                <button class="text-red-600 hover:text-red-800"><i data-lucide="trash-2" class="w-5 h-5"></i></button>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endif ?>
      </tbody>
    </table>
  </div>

  <!-- Tab Content: Add Product Form -->
  <div x-show="tab === 'add'" x-cloak>
    <form method="POST" action="" enctype="multipart/form-data" class="space-y-4">
      <input name="name" required placeholder="Product name" class="w-full p-3 border rounded" />
      <input type="number" step="0.01" name="price" required placeholder="Price" class="w-full p-3 border rounded" />
      <input type="number" name="stock" required placeholder="Stock quantity" class="w-full p-3 border rounded" />
      <input type="file" name="file"  class="w-full"  />
      <textarea name="description" required placeholder="Description" class="w-full p-3 border rounded" ></textarea>
      <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">Add Product</button>
    </form>
  </div>
</div>



<!-- Activate icons -->
<script>
  lucide.createIcons();
</script>