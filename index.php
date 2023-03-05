<?php

declare(strict_types=1);

session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . './views/partials/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . './database/DB.php';


$message = 'Pres button for seed data base';
if (isset($_SESSION['seeded'])) {
    $message = 'Data successfully added, app working';
}
?>

<main class="mx-auto container px-[15px]">
    <div class="py-20">
        <h1 class="uppercase font-bold text-4xl text-indigo-600 mb-12 text-center">
            <?= $message ?></h1>
                <div class="overflow-x-auto relative text-center sm:rounded-lg ">
                    <?php if (!isset($_SESSION['seeded'])): ?>
                    <form action="create_db_tables.php" method="POST">
                        <button type="submit"
                            class="transition duration-500 text-gray-200 group inline-flex items-center rounded-md bg-gray-800 text-base font-medium hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2  px-4 py-2 hover:rounded-md hover:text-white   hover:bg-indigo-600">
                            Seed data
                            <button>
                                <?php $_SESSION['seeded'] = true ?>
                    </form>
                    <?php endif; ?>
                </div>
    </div>
    </div>
</main>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . './views/partials/footer.php';