<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name'             => $faker->name,
        'email'            => $faker->unique()->safeEmail,
        'password'         => $password ?: $password = bcrypt('secret'),
        'gender'           => $faker->randomElement(['male', 'female']),
        'remember_token'   => str_random(10),
        'phone_number'     => $faker->phoneNumber,
        'profile_image_id' => 0,
    ];
});

$factory->define(\App\Models\AdminUser::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name'             => $faker->name,
        'email'            => $faker->unique()->safeEmail,
        'password'         => $password ?: $password = bcrypt('secret'),
        'profile_image_id' => 0,
        'remember_token'   => '',
    ];
});

$factory->define(\App\Models\AdminUserRole::class, function (Faker\Generator $faker) {
    return [
        'admin_user_id' => 0,
        'role'          => '',
    ];
});

$factory->define(\App\Models\File::class, function (Faker\Generator $faker) {
    return [
        'url'                => $faker->url,
        'title'              => $faker->sentence,
        'entity_type'        => '',
        'entity_id'          => 0,
        'storage_type'       => '',
        'file_type'          => '',
        'file_category_type' => '',
        's3_key'             => $faker->word,
        's3_bucket'          => '',
        's3_region'          => '',
        's3_extension'       => '',
        'media_type'         => '',
        'format'             => '',
        'file_size'          => 0,
        'original_file_name' => $faker->word,
        'width'              => 0,
        'height'             => 0,
        'is_enabled'         => true,
        'thumbnails'         => [],
    ];
});

$factory->define(\App\Models\Event::class, function (Faker\Generator $faker) {
    return [
        'name'        => $faker->name,
        'description' => '',
        'is_public'   => $faker->boolean,
        'group_id'    => 0,
        'location'    => '',
        'longitude'   => 0.0,
        'latitude'    => 0.0,
        'duration'    => 1,
        'slots'       => 1,
        'start_at'    => $this->faker->dateTimeBetween('-1 years'),
   ];
});

$factory->define(\App\Models\EventTicket::class, function (Faker\Generator $faker) {
    return [
        'event_id'            => 0,
        'name'                => $faker->name,
        'description'         => '',
        'price'               => 0,
        'regular_price'       => 0,
        'price_currency_code' => $faker->currencyCode,
        'quantity'            => 0,
        'booking_start_at'    => $faker->dateTime,
        'booking_end_at'      => $faker->dateTime,
    ];
});

$factory->define(\App\Models\EventTimetable::class, function (Faker\Generator $faker) {
    return [
        'event_id'    => 0,
        'name'        => $faker->name,
        'description' => '',
        'start_at'    => $faker->dateTime,
        'end_at'      => $faker->dateTime,
        'location'    => '',
        'longitude'   => 0.0,
        'latitude'    => 0.0,
        'type'        => '',
    ];
});

$factory->define(\App\Models\EventTicketTimetable::class, function (Faker\Generator $faker) {
    return [
        'event_ticket_id'     => 0,
        'event_time_table_id' => 0,
    ];
});

$factory->define(\App\Models\EventBooking::class, function (Faker\Generator $faker) {
    return [
        'user_id'                 => 0,
        'event_ticket_id'         => 0,
        'quantity'                => 0,
        'purchase_method_type'    => '',
        'purchase_transaction_id' => '',
    ];
});

$factory->define(\App\Models\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
    ];
});

$factory->define(\App\Models\EventCategory::class, function (Faker\Generator $faker) {
    return [
        'event_id'    => 0,
        'category_id' => 0,
    ];
});

$factory->define(\App\Models\EventImage::class, function (Faker\Generator $faker) {
    return [
        'event_id' => 0,
        'file_id'  => 0,
        'type'     => '',
    ];
});

$factory->define(\App\Models\Coupon::class, function (Faker\Generator $faker) {
    return [
        'event_id'    => 0,
        'name'        => $faker->name,
        'description' => '',
        'start_at'    => $faker->dateTime,
        'end_at'      => $faker->dateTime,
        'is_enabled'  => $faker->boolean,
    ];
});

$factory->define(\App\Models\Group::class, function (Faker\Generator $faker) {
    return [
        'name'     => $faker->name,
        'type'     => \App\Models\Group::TYPE_PRIVATE,
        'image_id' => 0,
    ];
});

$factory->define(\App\Models\GroupUser::class, function (Faker\Generator $faker) {
    return [
        'group_id'             => 0,
        'user_id'              => 0,
        'last_read_message_id' => 0,
        'role'                 => '',
    ];
});

$factory->define(\App\Models\GroupInvitation::class, function (Faker\Generator $faker) {
    return [
        'group_id'        => 0,
        'user_id'         => 0,
        'inviter_user_id' => 0,
        'status'          => \App\Models\GroupInvitation::STATUS_INVITED,
    ];
});

$factory->define(\App\Models\Message::class, function (Faker\Generator $faker) {
    return [
        'group_id' => 0,
        'user_id'  => 0,
        'content'  => '',
        'type'     => '',
        'data'     => '',
    ];
});

$factory->define(\App\Models\Poll::class, function (Faker\Generator $faker) {
    return [
        'group_id'    => 0,
        'message_id'  => 0,
        'event_id'    => 0,
        'description' => '',
    ];
});

$factory->define(\App\Models\PollAnswer::class, function (Faker\Generator $faker) {
    return [
        'poll_id'        => 0,
        'poll_option_id' => 0,
        'user_id'        => 0,
    ];
});

$factory->define(\App\Models\PollOption::class, function (Faker\Generator $faker) {
    return [
        'poll_id'            => 0,
        'option'             => '',
        'event_timetable_id' => 0,
    ];
});

$factory->define(\App\Models\EventAttendance::class, function (Faker\Generator $faker) {
    return [
        'event_id' => 0,
        'user_id'  => 0,
        'status'   => '',
    ];
});

$factory->define(\App\Models\PushNotificationDevice::class, function (Faker\Generator $faker) {
    return [
        'user_id' => 0,
        'token'   => str_random(10),
        'type'    => $faker->randomElement(['ios', 'android', 'web']),
    ];
});

$factory->define(\App\Models\Interest::class, function (Faker\Generator $faker) {
    return [
        'user_id'  => 0,
        'event_id' => 0,
    ];
});

$factory->define(\App\Models\UserServiceAuthentication::class, function (Faker\Generator $faker) {
    return [
        'user_id'    => 0,
        'name'       => $faker->name,
        'email'      => $faker->unique()->safeEmail,
        'service'    => '',
        'service_id' => '',
    ];
});

$factory->define(\App\Models\OauthAccessToken::class, function (Faker\Generator $faker) {
    return [
        'user_id'    => 0,
        'client_id'  => 0,
        'name'       => $faker->name,
        'scopes'     => '',
        'revoked'    => $faker->boolean,
        'expires_at' => $faker->dateTime,
    ];
});

$factory->define(\App\Models\OauthClient::class, function (Faker\Generator $faker) {
    return [
        'user_id'                => 0,
        'name'                   => $faker->name,
        'secret'                 => '',
        'redirect'               => '',
        'personal_access_client' => $faker->boolean,
        'password_client'        => $faker->boolean,
        'revoked'                => $faker->boolean,
    ];
});

$factory->define(\App\Models\OauthRefreshToken::class, function (Faker\Generator $faker) {
    return [
        'access_token_id' => '',
        'revoked'         => $faker->boolean,
        'expires_at'      => $faker->dateTime,
    ];
});

$factory->define(\App\Models\GroupCategory::class, function (Faker\Generator $faker) {
    return [
        'group_id'    => 0,
        'category_id' => 0,
    ];
});

$factory->define(\App\Models\GroupRequest::class, function (Faker\Generator $faker) {
    return [
        'group_id' => 0,
        'user_id'  => 0,
        'status'   => \App\Models\GroupRequest::STATUS_APPLIED,
    ];
});

$factory->define(\App\Models\GroupUser::class, function (Faker\Generator $faker) {
    return [
        'group_id'             => 0,
        'user_id'              => 0,
        'role'                 => '',
        'last_read_message_id' => 0,
        'favorite'             => false,
    ];
});

$factory->define(\App\Models\EventOrganizer::class, function (Faker\Generator $faker) {
    return [
        'event_id'  => 0,
        'user_id'   => 0,
        'role'      => \App\Models\EventOrganizer::ROLE_MEMBER,
    ];
});

$factory->define(\App\Models\EventOrganizer::class, function (Faker\Generator $faker) {
    return [
        'event_id'  => 0,
        'user_id'   => 0,
        'role'      => \App\Models\EventOrganizer::ROLE_MEMBER,
    ];
});

$factory->define(\App\Models\KetquaMienbac::class, function (Faker\Generator $faker) {
    return [
        'province_id' => 0,
        'ngay_quay' => '',
        'giai_dacbiet' => '',
        'giai_nhat' => '',
        'giai_nhi_1' => '',
        'giai_nhi_2' => '',
        'giai_ba_1' => '',
        'giai_ba_2' => '',
        'giai_ba_3' => '',
        'giai_ba_4' => '',
        'giai_ba_5' => '',
        'giai_ba_6' => '',
        'giai_tu_1' => '',
        'giai_tu_2' => '',
        'giai_tu_3' => '',
        'giai_tu_4' => '',
        'giai_nam_1' => '',
        'giai_nam_2' => '',
        'giai_nam_3' => '',
        'giai_nam_4' => '',
        'giai_nam_5' => '',
        'giai_nam_6' => '',
        'giai_sau_1' => '',
        'giai_sau_2' => '',
        'giai_sau_3' => '',
        'giai_bay_1' => '',
        'giai_bay_2' => '',
        'giai_bay_3' => '',
        'giai_bay_4' => '',
        'create_user' => '',
        'modify_user' => '',
        'create_date' => $faker->dateTime,
        'modify_date' => $faker->dateTime,
    ];
});

$factory->define(\App\Models\KetquaMienbac::class, function (Faker\Generator $faker) {
    return [
        'province_id' => 0,
        'ngay_quay' => '',
        'giai_dacbiet' => '',
        'giai_nhat' => '',
        'giai_nhi_1' => '',
        'giai_nhi_2' => '',
        'giai_ba_1' => '',
        'giai_ba_2' => '',
        'giai_ba_3' => '',
        'giai_ba_4' => '',
        'giai_ba_5' => '',
        'giai_ba_6' => '',
        'giai_tu_1' => '',
        'giai_tu_2' => '',
        'giai_tu_3' => '',
        'giai_tu_4' => '',
        'giai_nam_1' => '',
        'giai_nam_2' => '',
        'giai_nam_3' => '',
        'giai_nam_4' => '',
        'giai_nam_5' => '',
        'giai_nam_6' => '',
        'giai_sau_1' => '',
        'giai_sau_2' => '',
        'giai_sau_3' => '',
        'giai_bay_1' => '',
        'giai_bay_2' => '',
        'giai_bay_3' => '',
        'giai_bay_4' => '',
        'create_user' => '',
        'modify_user' => '',
        'create_date' => $faker->dateTime,
        'modify_date' => $faker->dateTime,
    ];
});

$factory->define(\App\Models\KetquaMiennam::class, function (Faker\Generator $faker) {
    return [
        'province_id' => 0,
        'ngay_quay' => '',
        'giai_dacbiet' => '',
        'giai_nhat' => '',
        'giai_nhi' => '',
        'giai_ba_1' => '',
        'giai_ba_2' => '',
        'giai_tu_1' => '',
        'giai_tu_2' => '',
        'giai_tu_3' => '',
        'giai_tu_4' => '',
        'giai_tu_5' => '',
        'giai_tu_6' => '',
        'giai_tu_7' => '',
        'giai_nam' => '',
        'giai_sau_1' => '',
        'giai_sau_2' => '',
        'giai_sau_3' => '',
        'giai_bay' => '',
        'giai_tam' => '',
        'create_user' => '',
        'modify_user' => '',
        'create_date' => $faker->dateTime,
        'modify_date' => $faker->dateTime,
    ];
});

$factory->define(\App\Models\KetquaMientrung::class, function (Faker\Generator $faker) {
    return [
        'province_id' => 0,
        'ngay_quay' => '',
        'giai_dacbiet' => '',
        'giai_nhat' => '',
        'giai_nhi' => '',
        'giai_ba_1' => '',
        'giai_ba_2' => '',
        'giai_tu_1' => '',
        'giai_tu_2' => '',
        'giai_tu_3' => '',
        'giai_tu_4' => '',
        'giai_tu_5' => '',
        'giai_tu_6' => '',
        'giai_tu_7' => '',
        'giai_nam' => '',
        'giai_sau_1' => '',
        'giai_sau_2' => '',
        'giai_sau_3' => '',
        'giai_bay' => '',
        'giai_tam' => '',
        'create_user' => '',
        'modify_user' => '',
        'create_date' => $faker->dateTime,
        'modify_date' => $faker->dateTime,
    ];
});

$factory->define(\App\Models\KetquaThantai::class, function (Faker\Generator $faker) {
    return [
        'province_id' => 0,
        'ngay_quay' => '',
        'ketqua' => '',
        'create_user' => '',
        'modify_user' => '',
        'create_date' => $faker->dateTime,
        'modify_date' => $faker->dateTime,
    ];
});

$factory->define(\App\Models\KetquaDientoan123::class, function (Faker\Generator $faker) {
    return [
        'province_id' => 0,
        'ngay_quay' => '',
        'ketqua_1' => '',
        'ketqua_2' => '',
        'ketqua_3' => '',
        'create_user' => '',
        'modify_user' => '',
        'create_date' => $faker->dateTime,
        'modify_date' => $faker->dateTime,
    ];
});

$factory->define(\App\Models\KetquaDientoan6x36::class, function (Faker\Generator $faker) {
    return [
        'province_id' => 0,
        'ngay_quay' => '',
        'ketqua_1' => '',
        'ketqua_2' => '',
        'ketqua_3' => '',
        'ketqua_4' => '',
        'ketqua_5' => '',
        'ketqua_6' => '',
        'create_user' => '',
        'modify_user' => '',
        'create_date' => $faker->dateTime,
        'modify_date' => $faker->dateTime,
    ];
});

$factory->define(\App\Models\KetquaMax4d::class, function (Faker\Generator $faker) {
    return [
        'ngay_mo' => '',
        'nhat' => '',
        'nhi_1' => '',
        'nhi_2' => '',
        'ba_1' => '',
        'ba_2' => '',
        'ba_3' => '',
        'kk_1' => '',
        'kk_2' => '',
        'nhat_so_giai' => '',
        'nhi_so_giai' => '',
        'ba_so_giai' => '',
        'kk_1_so_giai' => '',
        'kk_2_so_giai' => '',
        'nhat_giai_tri' => '',
        'nhi_giai_tri' => '',
        'ba_giai_tri' => '',
        'kk_1_giai_tri' => '',
        'kk_2_giai_tri' => '',
        'create_date' => $faker->dateTime,
    ];
});

$factory->define(\App\Models\KetquaMega645::class, function (Faker\Generator $faker) {
    return [
        'ngay_mo' => '',
        'ky_ve' => '',
        'bo_1' => '',
        'bo_2' => '',
        'bo_3' => '',
        'bo_4' => '',
        'bo_5' => '',
        'bo_6' => '',
        'jackpot_so_giai' => '',
        'jackpot_gia_tri' => '',
        'nhat_so_giai' => '',
        'nhat_gia_tri' => '',
        'nhi_so_giai' => '',
        'nhi_gia_tri' => '',
        'ba_so_giai' => '',
        'ba_gia_tri' => '',
        'create_date' => $faker->dateTime,
    ];
});

$factory->define(\App\Models\ThongkeLotoGanCucdai::class, function (Faker\Generator $faker) {
    return [
        'boso' => 0,
        'lanquay_cucdai' => '',
        'start_date' => '',
        'end_date' => '',
        'lanquay_chuave' => 0,
        'ngay_quay' => '',
        'create_date' => $faker->dateTime,
        'modify_date' => $faker->dateTime,
        'create_user' => '',
        'modify_user' => '',
    ];
});

$factory->define(\App\Models\ThongkeLotoDenky::class, function (Faker\Generator $faker) {
    return [
        'boso' => 0,
        'dodai_chuky' => '',
        'start_date' => '',
        'end_date' => '',
        'type' => 0,
        'create_date' => $faker->dateTime,
        'modify_date' => $faker->dateTime,
        'create_user' => '',
        'modify_user' => '',
    ];
});

$factory->define(\App\Models\ThongkeChukyBoso::class, function (Faker\Generator $faker) {
    return [
        'province_id' => 0,
        'boso' => '',
        'start_date' => '',
        'end_date' => '',
        'length' => 0,
        'is_special' => 0,
    ];
});

$factory->define(\App\Models\ThongkeLotoMienbac::class, function (Faker\Generator $faker) {
    return [
        'ketqua_id' => 0,
        'province_id' => 0,
        'boso' => '',
        'thu' => 0,
        'is_dacbiet' => 0,
        'is_tongchan' => 0,
        'is_tongle' => 0,
        'is_bochanle' => 0,
        'is_bolechan' => 0,
        'is_bochanchan' => 0,
        'is_bolele' => 0,
        'is_bokep' => 0,
        'is_bosatkep' => 0,
        'tan_so' => 0,
        'dau_so' => 0,
        'dit_so' => 0,
        'tong_bo' => 0,
        'giai' => '',
        'ngay_quay' => '',
        'create_user' => '',
        'modify_user' => '',
        'create_date' => $faker->dateTime,
        'modify_date' => $faker->dateTime,
    ];
});

$factory->define(\App\Models\ThongkeLotoMiennam::class, function (Faker\Generator $faker) {
    return [
        'ketqua_id' => 0,
        'province_id' => 0,
        'boso' => '',
        'thu' => 0,
        'is_dacbiet' => $faker->boolean,
        'is_tongchan' => $faker->boolean,
        'is_tongle' => $faker->boolean,
        'is_bochanle' => $faker->boolean,
        'is_bolechan' => $faker->boolean,
        'is_bochanchan' => $faker->boolean,
        'is_bolele' => $faker->boolean,
        'is_bokep' => $faker->boolean,
        'is_bosatkep' => $faker->boolean,
        'tan_so' => $faker->boolean,
        'dau_so' => $faker->boolean,
        'dit_so' => $faker->boolean,
        'tong_bo' => $faker->boolean,
        'giai' => '',
        'ngay_quay' => '',
        'create_user' => '',
        'modify_user' => '',
        'create_date' => $faker->dateTime,
        'modify_date' => $faker->dateTime,
    ];
});

$factory->define(\App\Models\ThongkeLotoMientrung::class, function (Faker\Generator $faker) {
    return [
        'ketqua_id' => 0,
        'province_id' => 0,
        'boso' => '',
        'thu' => 0,
        'is_dacbiet' => $faker->boolean,
        'is_tongchan' => $faker->boolean,
        'is_tongle' => $faker->boolean,
        'is_bochanle' => $faker->boolean,
        'is_bolechan' => $faker->boolean,
        'is_bochanchan' => $faker->boolean,
        'is_bolele' => $faker->boolean,
        'is_bokep' => $faker->boolean,
        'is_bosatkep' => $faker->boolean,
        'tan_so' => $faker->boolean,
        'dau_so' => $faker->boolean,
        'dit_so' => $faker->boolean,
        'tong_bo' => $faker->boolean,
        'giai' => '',
        'ngay_quay' => '',
        'create_user' => '',
        'modify_user' => '',
        'create_date' => $faker->dateTime,
        'modify_date' => $faker->dateTime,
    ];
});

$factory->define(\App\Models\Province::class, function (Faker\Generator $faker) {
    return [
        'code' => '',
        'name' => $faker->name,
        'alias' => '',
        'name_print' => '',
        'region' => $faker->boolean,
        'thu_2' => $faker->boolean,
        'thu_3' => $faker->boolean,
        'thu_4' => $faker->boolean,
        'thu_5' => $faker->boolean,
        'thu_6' => $faker->boolean,
        'thu_7' => $faker->boolean,
        'thu_8' => $faker->boolean,
        'create_user' => '',
        'modify_user' => '',
        'create_date' => $faker->dateTime,
        'modify_date' => $faker->dateTime,
    ];
});

$factory->define(\App\Models\ThongkeBosoVeLientiep::class, function (Faker\Generator $faker) {
    return [
        'province_id' => 0,
        'boso' => '',
        'start_date' => '',
        'end_date' => '',
        'length' => 0,
    ];
});

$factory->define(\App\Models\XAppHeader::class, function (Faker\Generator $faker) {
    return [
    ];
});

$factory->define(\App\Models\XAppClient::class, function (Faker\Generator $faker) {
    return [
    ];
});

$factory->define(\App\Models\XChot::class, function (Faker\Generator $faker) {
    return [
    ];
});

$factory->define(\App\Models\XUserPoint::class, function (Faker\Generator $faker) {
    return [
    ];
});

$factory->define(\App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'account_id' => 0,
        'facebook_id' => '',
        'email' => $faker->unique()->safeEmail,
        'full_name' => '',
        'avatar' => '',
        'mobile' => '',
        'is_owner' => 0,
        'remember_token' => '',
    ];
});

$factory->define(\App\Models\Account::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'country' => '',
    ];
});

$factory->define(\App\Models\Page::class, function (Faker\Generator $faker) {
    return [
        'facebook_id' => '',
        'name' => $faker->name,
        'access_token' => '',
        'page_token' => '',
        'category' => '',
        'picture_url' => '',
    ];
});

$factory->define(\App\Models\PageUser::class, function (Faker\Generator $faker) {
    return [
        'user_id' => 0,
        'page_id' => 0,
    ];
});

$factory->define(\App\Models\Customer::class, function (Faker\Generator $faker) {
    return [
        'facebook_id' => '',
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'mobile' => '',
        'gender' => '',
        'opted_in_through' => '',
        'time_subscribed' => $faker->dateTime,
        'avatar_url' => '',
        'subscribed' => $faker->boolean,
        'can_reply' => $faker->boolean,
        'country' => '',
        'address' => '',
    ];
});

$factory->define(\App\Models\feed::class, function (Faker\Generator $faker) {
    return [
        'page_id' => 0,
        'feed_facebook_id' => '',
        'message' => '',
        'description' => '',
        'picture' => '',
        'full_picture' => '',
        'caption' => '',
        'admin_creator_name' => '',
        'admin_creator_id' => '',
        'created_time' => $faker->dateTime,
        'link' => '',
        'from_name' => '',
        'from_id' => '',
        'is_hidden' => $faker->boolean,
        'is_published' => $faker->boolean,
        'is_popular' => $faker->boolean,
        'is_expired' => $faker->boolean,
        'is_spherical' => $faker->boolean,
        'subscribed' => $faker->boolean,
    ];
});

$factory->define(\App\Models\Feed::class, function (Faker\Generator $faker) {
    return [
        'page_id' => 0,
        'feed_facebook_id' => '',
        'message' => '',
        'description' => '',
        'picture' => '',
        'full_picture' => '',
        'caption' => '',
        'admin_creator_name' => '',
        'admin_creator_id' => '',
        'created_time' => $faker->dateTime,
        'link' => '',
        'from_name' => '',
        'from_id' => '',
        'is_hidden' => $faker->boolean,
        'is_published' => $faker->boolean,
        'is_popular' => $faker->boolean,
        'is_expired' => $faker->boolean,
        'is_spherical' => $faker->boolean,
        'subscribed' => $faker->boolean,
    ];
});

$factory->define(\App\Models\CustomerCustomField::class, function (Faker\Generator $faker) {
    return [
        'page_id' => 0,
        'field' => '',
        'type' => '',
        'description' => '',
        'status' => $faker->boolean,
    ];
});

$factory->define(\App\Models\Tag::class, function (Faker\Generator $faker) {
    return [
        'page_id' => 0,
        'tag' => '',
        'matched' => 0,
    ];
});

$factory->define(\App\Models\TagCustomer::class, function (Faker\Generator $faker) {
    return [
        'tag_id' => 0,
        'customer_id' => 0,
    ];
});

/* NEW MODEL FACTORY */
