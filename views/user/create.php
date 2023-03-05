<?php

declare(strict_types=1);

use App\Controllers\GroupController;

session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/database/DB.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/views/partials/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/Controllers/GroupController.php';

$obj1 = new GroupController();
$groups = $obj1->index();

?>

<main class="mx-auto container px-[15px]">
    <div class="py-20">
        <h1 class="uppercase font-bold text-4xl text-indigo-600 mb-8">Create User</h1>
        <form id="mainForm" action="/views/user/store.php" method="POST" class="mb-14">
            <?php
            include_once $_SERVER['DOCUMENT_ROOT'] . '/views/partials/message.php'; ?>

            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div>
                    <label for="first_name" class="block mb-2 text-sm font-medium text-indigo-500">First
                        Name</label>
                    <input type="text" id="first_name" name="first_name"
                        class=" border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Write your first name">
                    <p class=" filled_success_help mt-2 text-xs"></p>
                </div>

                <div>
                    <label for="last_name" class="block mb-2 text-sm font-medium text-indigo-500">Last Name</label>
                    <input type="text" id="last_name" name="last_name"
                        class=" border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Write your last name">
                    <p class=" filled_success_help mt-2 text-xs"></p>
                </div>

                <div>
                    <label for="date_of_birth" class="block mb-2 text-sm font-medium text-indigo-500">Date Of
                        Birth</label>
                    <input type="date" id="date_of_birth" name="date_of_birth"
                        class=" border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Write date of birth ">
                    <p class=" filled_success_help mt-2 text-xs"></p>
                </div>

                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-indigo-500">Password</label>
                    <input type="text" id="password" name="password"
                        class=" border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Write your password">
                    <p class=" filled_success_help mt-2 text-xs"></p>
                </div>

                <div>
                    <label for="dropdownGroupsButton" class="block mb-2 text-sm font-medium text-indigo-500">Select
                        Group</label>
                    <button id="dropdownGroupsButton" data-dropdown-toggle="dropdownGroups"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        type="button">Select Group <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg></button>
                    <p class=" filled_success_help mt-2 text-xs"></p>
                    <!-- Dropdown menu -->
                    <div id="dropdownGroups" class="z-10 hidden bg-white rounded-lg shadow w-60 dark:bg-gray-700">
                        <ul class="h-48 p-3 overflow-y-auto text-sm text-gray-700 dark:text-gray-200"
                            aria-labelledby="dropdownGroupsButton">
                            <?php
                            if ($groups): ?>
                                <?php
                                foreach ($groups as $group): ?>
                                    <li>
                                        <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                            <input id="checkbox-item-<?= $group['id'] ?>" type="checkbox" name="group[]"
                                                value="<?= $group['id'] ?>"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="checkbox-item-<?= $group['id'] ?>"
                                                class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300"><?= $group['name'] ?></label>
                                        </div>
                                    </li>
                                    <?php
                                endforeach;
                            else: ?>

                                <?php
                            endif ?>


                        </ul>
                        
                    </div>
                </div>
            </div>
            <input type="text" hidden name="action" value="add_user">
            <button type="submit" title="Add user button"
                class="text-white bg-indigo-600 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">
                Add User
            </button>
            <a href="/views/user/index.php/?seedDb" title="Back to user list"
                class="text-white ml-3 bg-pink-600  hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-pink-600 dark:hover:bg-pink-700 dark:focus:ring-indigo-800">
                Back
            </a>
        </form>
        <!--FORM-->
    </div>
</main>

<script type="text/javascript">

    const form = document.getElementById('mainForm');

    const firstName = document.getElementById('first_name');
    const lastName = document.getElementById('last_name');
    const dateOfBirth = document.getElementById('date_of_birth');
    const password = document.getElementById('password');
    const checkedCheckboxes = document.getElementById('dropdownGroupsButton');
    // const quantity = document.getElementById('group');


    form.addEventListener('submit', (e) => {
        e.preventDefault();
        checkInputs();
    });

    function checkCheckboxes() {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        var checkedCheckboxes = [];
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                checkedCheckboxes.push(checkboxes[i].id);
            }
        }
        return (checkedCheckboxes.length > 0)
    }


    function checkInputs() {
        const firstNameValue = firstName.value.trim();
        const lastNameValue = lastName.value.trim();
        const dateOfBirthValue = dateOfBirth.value.trim();
        const passwordValue = password.value.trim();


        const validFields = {
            "isValidFirstNameField": false,
            "isValidLastNameField": false,
            "isValidDateOfBirthField": false,
            "isValidPasswordField": false,
            "isValidCheckboxesField": false,

        };

        if (!checkCheckboxes()) {
            setErrorFor(checkedCheckboxes, 'At least one group must be selected');
        } else {
            validFields['isValidCheckboxesField'] = setSuccessFor(checkedCheckboxes);
        }

        if (firstNameValue === '') {
            setErrorFor(firstName, 'Field First Name is required');
        } else {
            validFields['isValidFirstNameField'] = setSuccessFor(firstName);
        }

        if (lastNameValue === '') {
            setErrorFor(lastName, 'Field Last Name is required');
        } else {
            validFields['isValidLastNameField'] = setSuccessFor(lastName);
        }

        if (dateOfBirthValue === '') {
            setErrorFor(dateOfBirth, 'Field Date Of Birth is required');
        } else {
            validFields['isValidDateOfBirthField'] = setSuccessFor(lastName);
        }

        if (passwordValue === '') {
            setErrorFor(password, 'Field Password is required');
        } else {
            validFields['isValidPasswordField'] = setSuccessFor(lastName);
        }


        if (validFields.isValidFirstNameField &&
            validFields.isValidLastNameField &&
            validFields.isValidDateOfBirthField &&
            validFields.isValidPasswordField && 
            validFields.isValidCheckboxesField) {
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