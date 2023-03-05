<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\User;

class UserController
{
    private User $model;

    public function __construct()
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/app/Models/User.php';
        $this->model = new User();
    }

    /**
     * Listing of the resource.
     *
     */
    public function index(?int $id = null): array
    {
        if ($id) {
            return [
                'users' => ($this->model->getAllUsers()) ? $this->model->getAllUsers() : false,
                'userGroups' => ($this->model->getAllUserGroups($id)) ? $this->model->getAllUserGroups($id) : false,
            ];
        } else {
            return [
                'users' => ($this->model->getAllUsers()) ? $this->model->getAllUsers() : false,
            ];
        }
    }

    /**
     * Edit the specified resource in storage.
     *
     */
    public function edit(int $id): array|false
    {
        return ($this->model->getUser($id)) ? $this->model->getUser($id) : false;
    }

    /**
     * Edit the specified resource in storage.
     *
     */
    public function editUserGroups(int $id): array|false
    {
        return ($this->model->getUserGroups($id)) ? $this->model->getUserGroups($id) : false;
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(string $first_name, string $last_name, string $password, string $date_of_birth, array $group_id): void
    {
        session_start();

        $this->checkStatusAction($this->model->setUser($first_name, $last_name, $password, $date_of_birth, $group_id), 'Added', $this->model->getModelName());
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(
        int $user_id,
        string $first_name,
        string $last_name,
        string $password,
        string $date_of_birth,
        array $group_ids,
    ): void
    {
        session_start();

        $this->checkStatusAction($this->model->updateUser($user_id, $first_name, $last_name, $password, $date_of_birth, $group_ids), 'Updated', $this->model->getModelName());
    }


    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(int $id): void
    {
        session_start();

        $this->checkStatusAction($this->model->deleteUser($id), 'Deleted', $this->model->getModelName());
    }

    /**
     * Helper function.
     *
     */
    public function checkStatusAction(mixed $action, string $actionName, string $sabjectName): void
    {
        if ($action) {
            $_SESSION['message'] = "$sabjectName $actionName Successfully";
            $_SESSION['is_successful'] = 'yes';
            header("Location: /views/user/index.php/");
        } else {
            $_SESSION['message'] = "$sabjectName Not $actionName. Error: ";
            header("Location: /views/user/index.php/");
        }
    }


}