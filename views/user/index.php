<?php

declare(strict_types=1);

use App\Controllers\UserController;

session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/database/DB.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/views/partials/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/Controllers/UserController.php';

$obj = new UserController();
$users = $obj->index();

?>

    <main class="mx-auto container px-[15px]">
        <div class="py-20">
            <?php
            include_once $_SERVER['DOCUMENT_ROOT'] . '/views/partials/message.php'; ?>
            <div class="hidden space-x-2 md:flex justify-end mb-12">

                <a title="Add user" href="/views/user/create.php/?seedDb"
                   class="transition duration-500 text-gray-200 group inline-flex items-center rounded-md bg-green-800 text-base font-medium hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2  px-4 py-2 hover:rounded-md hover:text-white   hover:bg-green-600">
                    <span>Add new user</span>
                </a>
            </div>

            <h1 class="uppercase font-bold text-4xl text-indigo-600 mb-12">Users list</h1>

            <div class="overflow-x-auto relative sm:rounded-lg ">
                <div class=" flex items-center justify-center ">

                    <div class=" flex items-center justify-center ">


                        <div class="overflow-x-auto relative">
                            <table class="w-full text-sm text-left  text-gray-400">
                                <thead
                                        class="text-xs  uppercase bg-gray-700 text-gray-400">
                                <tr>
                                    <th scope="col" class="py-3 px-6 ">
                                        Username
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        First Name
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Last Name
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Date Of Birth
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        User Group
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Action
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if ($users['users']):
                                    foreach ($users['users'] as $user): ?>
                                        <tr class=" border-b bg-gray-900 border-gray-700 text-center">
                                            <td class="px-2 py-4">
                                                <?= $user['username'] ?> </td>
                                            <td class="px-2 py-4">
                                                <?= $user['first_name'] ?> </td>
                                            <td class="px-2 py-4 ">
                                                <?= $user['last_name'] ?> </td>
                                            <td class="px-2 py-4 ">
                                                <?= $user['date_of_birth'] ?> </td>
                                            <td class="px-2 py-4 ">
                                                <?php
                                                $userGroups = $obj->index($user['user_id']);
                                                if($userGroups){
                                                    foreach ($userGroups['userGroups'] as $userGroup){
                                                        echo $userGroup['name'] . ', ';
                                                    }
                                                }else{
                                                    echo 'Empty';
                                                }
                                                
                                                ?>
                                            </td>
                                            <td class="pl-6 pr-3 py-4 flex  space-x-2">
                                                <a title="Edit order"
                                                   class="py-1 px-1 text-white rounded transition duration-300 hover:bg-green-600   bg-green-800"
                                                   href="/views/user/edit.php/?id=<?= $user['user_id'] ?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                         class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"/>
                                                    </svg>
                                                </a>
                                                <a title="Delete order"
                                                   class="py-1 px-1 text-white rounded transition duration-300 hover:bg-red-600  bg-red-800"
                                                   href="/views/user/delete.php/?id=<?= $user['user_id'] ?>&action=delete_user">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                         class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php
                                    endforeach; ?>
                                <?php
                                else: ?>
                                    <td class="px-2 py-4 ">
                                        There are no users, on database <strong>0</strong>, please add first user to
                                        database.
                                    </td>
                                <?php
                                endif; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>

            </div>


    </main>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . './views/partials/footer.php';
