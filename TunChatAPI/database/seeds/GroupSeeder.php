<?php

/**
 * Created by PhpStorm.
 * User: ThangTT
 * Date: 19/06/2017
 * Time: 5:07 CH
 */
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
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

		/** @var \App\Repositories\GroupRepositoryInterface $groupRepository */
		$groupRepository=\App::make('App\Repositories\GroupRepositoryInterface');
		/** @var \App\Repositories\GroupUserRepositoryInterface $groupUserRepository */
		$groupUserRepository=\App::make('App\Repositories\GroupUserRepositoryInterface');

		$group=$groupRepository->create([
			'name'              =>$this->faker->name,
			'type'              =>$this->faker->randomElement(['private', 'secret']),
			'image_id'          =>$this->faker->numberBetween(1,8),
		]);

		$categoryIds = [1,2];
		$group->categories()->sync($categoryIds);
		$groupUserRepository->create([
			"group_id"          =>$group->id,
			"user_id"           =>$this->faker->numberBetween(1,8),
			"role"              =>$this->faker->randomElement(['owner', 'member']),
		]);

		$group=$groupRepository->create([
			'name'              =>$this->faker->name,
			'type'              =>$this->faker->randomElement(['private', 'secret']),
			'image_id'          =>$this->faker->numberBetween(1,8),
		]);
		$categoryIds = [3,4];
		$group->categories()->sync($categoryIds);
		$groupUserRepository->create([
			"group_id"          =>$group->id,
			"user_id"           =>$this->faker->numberBetween(1,8),
			"role"              =>$this->faker->randomElement(['owner', 'member']),
		]);


		$group=$groupRepository->create([
			'name'              =>$this->faker->name,
			'type'              =>$this->faker->randomElement(['private', 'secret']),
			'image_id'          =>$this->faker->numberBetween(1,8),
		]);
		$categoryIds = [5,6];
		$group->categories()->sync($categoryIds);
		$groupUserRepository->create([
			"group_id"          =>$group->id,
			"user_id"           =>$this->faker->numberBetween(1,8),
			"role"              =>$this->faker->randomElement(['owner', 'member']),
		]);


		$group=$groupRepository->create([
			'name'              =>$this->faker->name,
			'type'              =>$this->faker->randomElement(['private', 'secret']),
			'image_id'          =>$this->faker->numberBetween(1,8),
		]);
		$categoryIds = [7,8];
		$group->categories()->sync($categoryIds);
		$groupUserRepository->create([
			"group_id"          =>$group->id,
			"user_id"           =>$this->faker->numberBetween(1,8),
			"role"              =>$this->faker->randomElement(['owner', 'member']),
		]);


		$group=$groupRepository->create([
			'name'              =>$this->faker->name,
			'type'              =>$this->faker->randomElement(['private', 'secret']),
			'image_id'          =>$this->faker->numberBetween(1,8),
		]);
		$categoryIds = [1,3];
		$group->categories()->sync($categoryIds);
		$groupUserRepository->create([
			"group_id"          =>$group->id,
			"user_id"           =>$this->faker->numberBetween(1,8),
			"role"              =>$this->faker->randomElement(['owner', 'member']),
		]);


		$group=$groupRepository->create([
			'name'              =>$this->faker->name,
			'type'              =>$this->faker->randomElement(['private', 'secret']),
			'image_id'          =>$this->faker->numberBetween(1,8),
		]);
		$categoryIds = [1,4];
		$group->categories()->sync($categoryIds);
		$groupUserRepository->create([
			"group_id"          =>$group->id,
			"user_id"           =>$this->faker->numberBetween(1,8),
			"role"              =>$this->faker->randomElement(['owner', 'member']),
		]);


		$group=$groupRepository->create([
			'name'              =>$this->faker->name,
			'type'              =>$this->faker->randomElement(['private', 'secret']),
			'image_id'          =>$this->faker->numberBetween(1,8),
		]);
		$categoryIds = [2,4];
		$group->categories()->sync($categoryIds);
		$groupUserRepository->create([
			"group_id"          =>$group->id,
			"user_id"           =>$this->faker->numberBetween(1,8),
			"role"              =>$this->faker->randomElement(['owner', 'member']),
		]);


		$group=$groupRepository->create([
			'name'              =>$this->faker->name,
			'type'              =>$this->faker->randomElement(['private', 'secret']),
			'image_id'          =>$this->faker->numberBetween(1,8),
		]);
		$categoryIds = [5,4];
		$group->categories()->sync($categoryIds);
		$groupUserRepository->create([
			"group_id"          =>$group->id,
			"user_id"           =>$this->faker->numberBetween(1,8),
			"role"              =>$this->faker->randomElement(['owner', 'member']),
		]);

		$i = 0;
		while($i<100){
			$group=$groupRepository->create([
				'name'              =>$this->faker->name,
				'type'              =>$this->faker->randomElement(['private', 'secret']),
				'image_id'          =>$this->faker->numberBetween(1,8),
			]);

			$categoryIds = [$this->faker->numberBetween(1,8),$this->faker->numberBetween(1,8)];

			$group->categories()->sync($categoryIds);

			$groupUserRepository->create([
				"group_id"          =>$group->id,
				"user_id"           =>$this->faker->numberBetween(1,8),
				"role"              =>$this->faker->randomElement(['owner', 'member']),
			]);
			$i++;
		}

	}
}