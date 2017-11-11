__# XS API Server

## Descriptions

**Need update**

## How To Set Up This App

## How To Start Your Project

First, you can clone this repository.


## Use Generators

On this boilerplate, I added many generators

Use `rocket:make:model`, `rocket:make:repository`, `rocket:make:service`, `rocket:make:helper` to create repositories, services, helpers.
And `rocket:make:admin-crud` to create admin crud.

The process for setting up the base structure will be following.

1. You can create migration with `rocket:make:migration:create` and create the tables
2. Create model with `rocket:make:model`
3. Create repository with `rocket:make:repository`
4. Create Admin CRUD with `rocket:make:admin-crud`
5. Create services and helpers with `make:service` and `make:helper` if needed.

These generators create test code also. You need to add more tests on these files.
