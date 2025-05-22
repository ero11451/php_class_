<?php

echo "<div class='container mt-5'>";
if (isset($_SESSION['notification'])): ?>
    <?php
    $notif = $_SESSION['notification'];
    $color = $notif['success'] ? 'bg-green-500' : 'bg-red-500';
    unset($_SESSION['notification']); // clear after displaying
    ?>
    <div id="notification" class="fixed top-5 right-5 px-6 py-4 text-white rounded shadow-lg <?php echo $color; ?>">
        <strong><?php echo htmlspecialchars($notif['message']); ?></strong>
        <?php if (!empty($notif['errors'])): ?>
            <ul class="mt-2 list-disc list-inside text-sm">
                <?php foreach ($notif['errors'] as $fieldErrors): ?>
                    <?php foreach ($fieldErrors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <button onclick="document.getElementById('notification').remove()" class="absolute top-1 right-2 text-white text-xl">&times;</button>
    </div>

    <script>
        setTimeout(() => {
            const notif = document.getElementById('notification');
            if (notif) notif.remove();
        }, 4000);
    </script>


<?php endif; ?>
<?php echo "</div>";
