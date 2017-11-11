<?php

/**
 * Created by PhpStorm.
 * User: ThangTT
 * Date: 19/06/2017
 * Time: 5:10 CH
 */
use Illuminate\Database\Seeder;
use App\Models\EventOrganizer;

class EventSeeder extends Seeder
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

		/** @var \App\Repositories\EventRepositoryInterface $eventRepository */
		$eventRepository=\App::make('App\Repositories\EventRepositoryInterface');
		/** @var \App\Repositories\EventOrganizerRepositoryInterface $eventOrganizerRepository */
		$eventOrganizerRepository=\App::make('App\Repositories\EventOrganizerRepositoryInterface');

		$i = 0;
		while($i<100){
		$event=$eventRepository->create([
			'name'          => $this->faker->name,
			'description'   => $this->faker->text(200),
			'is_public'     => 1,
			'group_id'      => 0,
			'location'      => $this->faker->city,
			'longitude'     => $this->faker->longitude,
			'latitude'      => $this->faker->latitude,
			'duration'      => $this->faker->numberBetween(1,8),
			'slots'         => $this->faker->numberBetween(1,800),
			'start_at'      => $this->faker->dateTimeBetween('-1 years'),

		]);

			$images = [$this->faker->numberBetween(1,8),$this->faker->numberBetween(1,8)];
			$event->images()->sync($images);
			$categoryIds = [$this->faker->numberBetween(1,8),$this->faker->numberBetween(1,8)];
			$event->categories()->sync($categoryIds);

			$eventOrganizerRepository->create([
				'user_id'   => $this->faker->numberBetween(1,8),
				'event_id'  => $event->id,
				'role'      => EventOrganizer::ROLE_OWNER,
			]);
			$i++;
		}

		$i = 0;
		while($i<50){
			$event=$eventRepository->create([
				'name'          => $this->faker->name,
				'description'   => $this->faker->text(200),
				'is_public'     => 0,
				'group_id'      => $this->faker->numberBetween(1,100),
				'location'      => $this->faker->city,
				'longitude'     => $this->faker->longitude,
				'latitude'      => $this->faker->latitude,
				'duration'      => $this->faker->numberBetween(1,8),
				'slots'         => $this->faker->numberBetween(1,800),
				'start_at'      => $this->faker->dateTimeBetween('-1 years'),

			]);

			$images = [$this->faker->numberBetween(1,8),$this->faker->numberBetween(1,8)];
			$event->images()->sync($images);
			$categoryIds = [$this->faker->numberBetween(1,8),$this->faker->numberBetween(1,8)];
			$event->categories()->sync($categoryIds);

			$eventOrganizerRepository->create([
				'user_id'   => $this->faker->numberBetween(1,8),
				'event_id'  => $event->id,
				'role'      => EventOrganizer::ROLE_OWNER,
			]);
			$i++;
		}
	}
}