<?php

declare(strict_types=1);

session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/views/partials/header.php';

?>

<main class="mx-auto container px-[15px]">
    <div class="py-20">
        <h1 class="uppercase font-bold text-4xl text-indigo-600 mb-8">Create Order</h1>
        <form id="mainForm" action="/views/group/store.php" method="POST" class="mb-14">

            <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/views/partials/message.php'; ?>

            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-indigo-500">Name</label>
                    <input type="text" id="name" name="name"
                        class=" border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Write group name">
                    <p class=" filled_success_help mt-2 text-xs"></p>
                </div>
            </div>
            <div class="space-9 flex lg:flex-col">
                <button type="submit" title="Add group button"
                    class="text-white bg-indigo-600 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">
                    Add Group
                </button>
                <a href="/views/group/index.php/?seedDb" title="Back to groups list"
                    class="text-white ml-3 bg-pink-600  hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-pink-600 dark:hover:bg-pink-700 dark:focus:ring-indigo-800">
                    Back
                </a>

            </div>

        </form>
        <!--FORM-->
    </div>
</main>

<script type="text/javascript">

    const form = document.getElementById('mainForm');
    const name = document.getElementById('name');

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        checkInputs();
    });

    function checkInputs() {
        const nameValue = name.value.trim();
        const validFields = {
            "isValidNameFiled": false,
        };

        if (nameValue === '') {
            setErrorFor(name, 'Field profit is required');

        } else {
            validFields['isValidNameFiled'] = setSuccessFor(name);
        }

        if (validFields.isValidNameFiled) {
            form.submit();
        }
    }

    function setErrorFor(input, message) {
        const formControl = input.parentElement;
        const small = formControl.querySelector('.filled_success_help');

        input.style.borderColor = 'rgb(220 38 38)';
        small.innerText = message;

        formControl.className = ' text-red-600 dark:text-red-400';
    }

    function setSuccessFor(input) {
        const formControl = input.parentElement;
        const small = formControl.querySelector('.filled_success_help');

        input.style.borderColor = '';
        small.innerText = '';

        formControl.className = 'text-green-600 dark:text-green-400';

        return true;
    }

</script>
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . './views/partials/footer.php';