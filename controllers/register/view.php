<div class="max-w-2xl mx-auto mt-10 p-6 bg-white">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Register</h1>

    <form method="post" action="" class="space-y-4 mb-8">
        <input
            class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            type="text" name="name" placeholder="Name..." required>
        <input
            class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" name="email" placeholder="Email..." required>
        <input type="password" name="password"
            class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Password..." required>
        <select name="role" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="">
            <option value="">Select Role</option>
            <option value="admin">Admin</option>
            <option value="user">User</option>
        </select>
        <button type="submit"
            class="w-full bg-black text-white font-semibold py-3 rounded-md hover:bg-black transition">Submit</button>
    </form>

    <div class="text-">
        <a href="/login" class="text-black hover:underline">I have an account? Login here</a>
    </div>


    <?php

    foreach ($data as $value) {
        // var_dump($value) ;

        foreach ($value as $v) {
            echo "<div class=''>";
            echo $v;
            echo "</div>";
        }
    }
    ?>

</div>