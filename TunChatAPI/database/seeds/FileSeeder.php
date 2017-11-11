<?php

/**
 * Created by PhpStorm.
 * User: ThangTT
 * Date: 19/06/2017
 * Time: 5:11 CH
 * /uploads/1645b75472968dea5e15c7dc15c9fd1f.jpg
 */

use Illuminate\Database\Seeder;

class FileSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run()
	{

		/** @var \App\Repositories\FileRepositoryInterface $fileRepository */
		$fileRepository=\App::make('App\Repositories\FileRepositoryInterface');

		$file=$fileRepository->create([
			'url'               =>'/uploads/1645b75472968dea5e15c7dc15c9fd1f.jpg',
			'storage_type'      =>'local',
			'file_type'         =>'image',
			'file_category_type'=>'default-file',
			's3_extension'      =>'jpg',
			'media_type'        =>'image/jpeg',
			'format'            =>'image/jpeg',
			'file_size'         =>'9527',
			'width'             =>0,
			'height'            =>0,
		]);

		$file=$fileRepository->create([
			'url'               =>'/uploads/1645b75472968dea5e15c7dc15c9fd1f.jpg',
			'storage_type'      =>'local',
			'file_type'         =>'image',
			'file_category_type'=>'default-file',
			's3_extension'      =>'jpg',
			'media_type'        =>'image/jpeg',
			'format'            =>'image/jpeg',
			'file_size'         =>'9527',
			'width'             =>0,
			'height'            =>0,
		]);

		$file=$fileRepository->create([
			'url'               =>'/uploads/1645b75472968dea5e15c7dc15c9fd1f.jpg',
			'storage_type'      =>'local',
			'file_type'         =>'image',
			'file_category_type'=>'default-file',
			's3_extension'      =>'jpg',
			'media_type'        =>'image/jpeg',
			'format'            =>'image/jpeg',
			'file_size'         =>'9527',
			'width'             =>0,
			'height'            =>0,
		]);

		$file=$fileRepository->create([
			'url'               =>'/uploads/1645b75472968dea5e15c7dc15c9fd1f.jpg',
			'storage_type'      =>'local',
			'file_type'         =>'image',
			'file_category_type'=>'default-file',
			's3_extension'      =>'jpg',
			'media_type'        =>'image/jpeg',
			'format'            =>'image/jpeg',
			'file_size'         =>'9527',
			'width'             =>0,
			'height'            =>0,
		]);

		$file=$fileRepository->create([
			'url'               =>'/uploads/1645b75472968dea5e15c7dc15c9fd1f.jpg',
			'storage_type'      =>'local',
			'file_type'         =>'image',
			'file_category_type'=>'default-file',
			's3_extension'      =>'jpg',
			'media_type'        =>'image/jpeg',
			'format'            =>'image/jpeg',
			'file_size'         =>'9527',
			'width'             =>0,
			'height'            =>0,
		]);

		$file=$fileRepository->create([
			'url'               =>'/uploads/1645b75472968dea5e15c7dc15c9fd1f.jpg',
			'storage_type'      =>'local',
			'file_type'         =>'image',
			'file_category_type'=>'default-file',
			's3_extension'      =>'jpg',
			'media_type'        =>'image/jpeg',
			'format'            =>'image/jpeg',
			'file_size'         =>'9527',
			'width'             =>0,
			'height'            =>0,
		]);

		$file=$fileRepository->create([
			'url'               =>'/uploads/1645b75472968dea5e15c7dc15c9fd1f.jpg',
			'storage_type'      =>'local',
			'file_type'         =>'image',
			'file_category_type'=>'default-file',
			's3_extension'      =>'jpg',
			'media_type'        =>'image/jpeg',
			'format'            =>'image/jpeg',
			'file_size'         =>'9527',
			'width'             =>0,
			'height'            =>0,
		]);


		$file=$fileRepository->create([
			'url'               =>'/uploads/1645b75472968dea5e15c7dc15c9fd1f.jpg',
			'storage_type'      =>'local',
			'file_type'         =>'image',
			'file_category_type'=>'default-file',
			's3_extension'      =>'jpg',
			'media_type'        =>'image/jpeg',
			'format'            =>'image/jpeg',
			'file_size'         =>'9527',
			'width'             =>0,
			'height'            =>0,
		]);


	}
}