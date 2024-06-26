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

function setHeaderInfo($arr) {
    $arr['active_flg'] = '1';
    $arr['created_at'] = \Carbon\Carbon::now();
    $arr['created_by'] = 1;
    $arr['updated_at'] = \Carbon\Carbon::now();
    $arr['updated_by'] = 1;
    $arr['version_no'] = 1;

    return $arr;
}

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'email_verified' => 1,
        'email_verification_code' => str_random(10),
        'avatar' => 'test',
        //use bcrypt('password') if you want to assert for a specific password, but it might slow down your tests
        'password' => str_random(10),
    ];
});

$factory->define(App\Models\PasswordReset::class, function (Faker\Generator $faker) {
    return [
        'email'  => $faker->safeEmail,
        'token' => str_random(10),
    ];
});

$factory->define(App\Models\MstDealer::class, function (Faker\Generator $faker) {
    return [
        'name' => "CTY " . $faker->company,
        'address' => $faker->address,
        'area1' => 1,
        'area2' => $faker->numberBetween(65, 75),
        'contact_name' => $faker->name,
        'contact_email' => $faker->email,
        'contact_tel' => $faker->phoneNumber,
        'contact_mobile1' => $faker->phoneNumber,
    ];
});

$factory->define(App\Models\MstStore::class, function (Faker\Generator $faker) {
    return [
        'name' => "CH " . $faker->company,
        'address' => $faker->address,
        'area1' => 1,
        'area2' => $faker->numberBetween(65, 75),
        'gps_lat' => $faker->latitude,
        'gps_long' => $faker->longitude,
        'new_store_id' => 0,
        'store_sts' => '0',
        'contact_name' => $faker->name,
        'contact_email' => $faker->email,
        'contact_tel' => $faker->phoneNumber,
        'contact_mobile1' => $faker->phoneNumber,
    ];
});

$factory->define(App\Models\TrnProductMarketHis::class, function (Faker\Generator $faker) {
    return setHeaderInfo([
        'warehouse_change_type' => $faker->numberBetween(1, 2),
        'product_market_id' => $faker->numberBetween(1, 80),
        'changed_date' => $faker->date,
        'price' => $faker->numberBetween(1, 100) * 100,
        'amount' => $faker->numberBetween(10, 200),
        'status' => $faker->numberBetween(1, 4),
        'description' => $faker->paragraph
    ]);
});

$factory->define(App\Models\TrnAttendance::class, function (Faker\Generator $faker) {
    return setHeaderInfo([
        'working_time' => $faker->dateTimeBetween('-1 months', 'now'),
        'user_id' => $faker->randomElement([1 ,2 ,3 ,4 ,5 ,8 ,9 ,25 ,26 ,27 ,28 ,29 ,30 ,32 ,33 ,34 ,35 ,36 ,39 ,40]),
        'ip' => $faker->ipv4,
        'agent' => $faker->userAgent,
        'event_name' => $faker->randomElement(["CHECKIN", "CHECKOUT"])
    ]);
});
