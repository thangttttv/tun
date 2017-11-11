<?php

/**
 * Created by PhpStorm.
 * User: ThangTT
 * Date: 19/06/2017
 * Time: 5:09 CH
 */
use Illuminate\Database\Seeder;
use \Faker\Generator;

class UserSeeder extends Seeder
{
	/** @var \Faker\Generator */
	protected $faker;


	public function __construct(
		\Faker\Generator $faker
	) {
		$this->faker           = $faker;

	}
	/**
	 * Run the database seeds.
	 */
	public function run()
	{

		/** @var \App\Repositories\UserRepositoryInterface $userRepository */
		$userRepository=\App::make('App\Repositories\UserRepositoryInterface');

		$user=$userRepository->create([
			'name'             => $this->faker->name,
			'email'            => $this->faker->unique()->safeEmail,
			'password'         =>  bcrypt('secret'),
			'gender'           => $this->faker->randomElement(['male', 'female']),
			'remember_token'   => str_random(10),
			'phone_number'     => $this->faker->phoneNumber,
			'profile_image_id' => 0,
		]);

		$user=$userRepository->create([
			'name'             => $this->faker->name,
			'email'            => $this->faker->unique()->safeEmail,
			'password'         =>  bcrypt('secret'),
			'gender'           => $this->faker->randomElement(['male', 'female']),
			'remember_token'   => str_random(10),
			'phone_number'     => $this->faker->phoneNumber,
			'profile_image_id' => 0,
		]);

		$user=$userRepository->create([
			'name'             => $this->faker->name,
			'email'            => $this->faker->unique()->safeEmail,
			'password'         =>  bcrypt('secret'),
			'gender'           => $this->faker->randomElement(['male', 'female']),
			'remember_token'   => str_random(10),
			'phone_number'     => $this->faker->phoneNumber,
			'profile_image_id' => 0,
		]);


		$user=$userRepository->create([
			'name'             => $this->faker->name,
			'email'            => $this->faker->unique()->safeEmail,
			'password'         =>  bcrypt('secret'),
			'gender'           => $this->faker->randomElement(['male', 'female']),
			'remember_token'   => str_random(10),
			'phone_number'     => $this->faker->phoneNumber,
			'profile_image_id' => 0,
		]);


		$user=$userRepository->create([
			'name'             => $this->faker->name,
			'email'            => $this->faker->unique()->safeEmail,
			'password'         =>  bcrypt('secret'),
			'gender'           => $this->faker->randomElement(['male', 'female']),
			'remember_token'   => str_random(10),
			'phone_number'     => $this->faker->phoneNumber,
			'profile_image_id' => 0,
		]);


		$user=$userRepository->create([
			'name'             => $this->faker->name,
			'email'            => $this->faker->unique()->safeEmail,
			'password'         =>  bcrypt('secret'),
			'gender'           => $this->faker->randomElement(['male', 'female']),
			'remember_token'   => str_random(10),
			'phone_number'     => $this->faker->phoneNumber,
			'profile_image_id' => 0,
		]);

		$user=$userRepository->create([
			'name'             => $this->faker->name,
			'email'            => $this->faker->unique()->safeEmail,
			'password'         =>  bcrypt('secret'),
			'gender'           => $this->faker->randomElement(['male', 'female']),
			'remember_token'   => str_random(10),
			'phone_number'     => $this->faker->phoneNumber,
			'profile_image_id' => 0,
		]);
		$user=$userRepository->create([
			'name'             => $this->faker->name,
			'email'            => $this->faker->unique()->safeEmail,
			'password'         =>  bcrypt('secret'),
			'gender'           => $this->faker->randomElement(['male', 'female']),
			'remember_token'   => str_random(10),
			'phone_number'     => $this->faker->phoneNumber,
			'profile_image_id' => 0,
		]);

		$user=$userRepository->create([
			'name'             => $this->faker->name,
			'email'            => $this->faker->unique()->safeEmail,
			'password'         =>  bcrypt('secret'),
			'gender'           => $this->faker->randomElement(['male', 'female']),
			'remember_token'   => str_random(10),
			'phone_number'     => $this->faker->phoneNumber,
			'profile_image_id' => 0,
		]);

		$user=$userRepository->create([
			'name'             => $this->faker->name,
			'email'            => $this->faker->unique()->safeEmail,
			'password'         =>  bcrypt('secret'),
			'gender'           => $this->faker->randomElement(['male', 'female']),
			'remember_token'   => str_random(10),
			'phone_number'     => $this->faker->phoneNumber,
			'profile_image_id' => 0,
		]);

	}
}