<?php

require_once __DIR__ . '/../../../../application/port/in/GetAllUserUseCase.php';
require_once __DIR__ . '/../../../../application/port/in/GetUserIdIUseCase.php';
require_once __DIR__ . '/../../../../application/port/in/CreateUserUseCase.php';
require_once __DIR__ . '/../../../../application/port/in/UpdateUserUseCase.php';
require_once __DIR__ . '/../../../../application/port/in/DeleteUserUseCase.php';
require_once __DIR__ . '/../../../../application/service/dto/query/GetAllUserQuery.php';

require_once __DIR__ . '/mapper/UserWebMapper.php';

class UserController{

    private GetAllUserUseCase $getAllUserUseCase;
    private GetUserIdIUseCase $getUserByIdUseCase;
    private CreateUserUseCase $createUserUseCase;
    private UpdateUserUseCase $updateUserUseCase;
    private DeleteUserUseCase $deleteUserUseCase;
    private UserWebMapper $mapper;

    public function __construct(
        GetAllUserUseCase $getAllUserUseCase,
        GetUserIdIUseCase $getUserByIdUseCase,
        CreateUserUseCase $createUserUseCase,
        UpdateUserUseCase $updateUserUseCase,
        DeleteUserUseCase $deleteUserUseCase,
        UserWebMapper $mapper
    ) {
        $this->getAllUserUseCase = $getAllUserUseCase;
        $this->getUserByIdUseCase = $getUserByIdUseCase;
        $this->createUserUseCase = $createUserUseCase;
        $this->updateUserUseCase = $updateUserUseCase;
        $this->deleteUserUseCase = $deleteUserUseCase;
        $this->mapper = $mapper;
    }

    /** @return UserResponse[] */
    public function index(): array{
        $users = $this->getAllUserUseCase->execute(new GetAllUserQuery());
        return $this->mapper->fromModelsToResponses($users);
    }

    public function show(string $id): UserResponse{
        $query = $this->mapper->fromIdToGetByIdQuery($id);
        $user = $this->getUserByIdUseCase->execute($query);
        return $this->mapper->fromModelToResponse($user);
    }

    public function store(CreateUserRequest $request): UserResponse{
        $command = $this->mapper->fromCreateRequestToCommand($request);
        $user = $this->createUserUseCase->execute($command);
        return $this->mapper->fromModelToResponse($user);
    }

    public function update(UpdateUserRequest $request): UserResponse{
        $command = $this->mapper->fromUpdateRequestToCommand($request);
        $user = $this->updateUserUseCase->execute($command);
        return $this->mapper->fromModelToResponse($user);
    }

    public function delete($id): void{
        $command = $this->mapper->fromIdToDeleteCommand($id);
        $this->deleteUserUseCase->execute($command);
    }

}